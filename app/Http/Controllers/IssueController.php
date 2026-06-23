<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;

class IssueController extends Controller
{
    public function index()
    {
        $query = Issue::with(['project', 'tags']);

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('priority')) {
            $query->where('priority', request('priority'));
        }

        if (request('tag_id')) {
            $query->whereHas('tags', function ($q) {
                $q->where('tags.id', request('tag_id'));
            });
        }

        $issues = $query->latest()->get();
        $tags = Tag::all();

        return view('issues.index', compact('issues', 'tags'));
    }

    public function create()
    {
        $projects = Project::all();

        return view('issues.create', compact('projects'));
    }

    public function store(StoreIssueRequest $request)
    {
        Issue::create($request->validated());

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully.');
    }

    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    public function edit(Issue $issue)
    {
        $projects = Project::all();

        return view('issues.edit', compact('issue', 'projects'));
    }

    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        return redirect()->route('issues.index')
            ->with('success', 'Issue updated successfully.');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully.');
    }
}