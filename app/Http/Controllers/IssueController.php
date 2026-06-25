<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;


class IssueController extends Controller
{
    public function index()
    {
        $query = Issue::with(['project', 'tags', 'users']);

        // Filter by status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Filter by priority
        if (request('priority')) {
            $query->where('priority', request('priority'));
        }

        // Filter issues by selected tag
        if (request('tag_id')) {
            $query->whereHas('tags', function ($q) {
                $q->where('tags.id', request('tag_id'));
            });
        }

        // Search by title or description
        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        $issues = $query->latest()->get();
        $tags = Tag::all();

        // Return only the table for AJAX requests.
        if (request()->ajax()) {
            return view('issues.table', compact('issues'))->render();
        }

        return view('issues.index', compact('issues', 'tags'));
    }

    public function create()
    {
        $projects = Project::all();
        $tags = Tag::all();
        $users = User::all();

        return view('issues.create', compact('projects', 'tags', 'users'));
    }

    public function store(StoreIssueRequest $request)
    {
        $data = $request->validated();

        $issue = Issue::create($data);

        $issue->tags()->sync($data['tags'] ?? []);

        // assign selected users
        $issue->users()->sync($data['users'] ?? []);

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully.');
    }

    public function show(Issue $issue)
    {
        $issue->load([
            'project',
            'tags',
            'comments',
            'users',
        ]);

        $tags = Tag::all();
        $users = User::all();

        return view('issues.show', compact('issue', 'tags', 'users'));
    }

    public function edit(Issue $issue)
    {
        $projects = Project::all();
        $tags = Tag::all(); // load tags
        $users = User::all(); // load available users

        return view('issues.edit', compact('issue', 'projects', 'tags', 'users'));
    }

    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $data = $request->validated();

        $issue->update($data);

        $issue->tags()->sync($data['tags'] ?? []);

        // update assigned users
        $issue->users()->sync($data['users'] ?? []);

        return redirect()->route('issues.index')
            ->with('success', 'Issue updated successfully.');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully.');
    }


    public function attachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->syncWithoutDetaching([$tag->id]);

        return response()->json([
            'message' => 'Tag attached successfully.',
        ]);
    }

    public function detachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);

        return response()->json([
            'message' => 'Tag detached successfully.',
        ]);
    }
}