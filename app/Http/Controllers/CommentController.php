<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Issue;

class CommentController extends Controller
{

    // oad comments with pagination for AJAX.
    // public function index(Issue $issue)
    // {
    //     $comments = $issue->comments()
    //         ->latest()
    //         ->paginate(5);

    //     return response()->view('comments.list', compact('comments'));
    // }
public function index(Issue $issue)
{
    $comments = $issue->comments()
        ->latest()
        ->paginate(5);

    return view('comments.list', compact('comments'));
}
    // add a comment
    public function store(StoreCommentRequest $request, Issue $issue)
    {
        $comment = $issue->comments()->create($request->validated());

        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ]);
    }

    //delete a comment

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully.',
        ]);
    }
}