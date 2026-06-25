@forelse($comments as $comment)
    <div class="comment-card">
        <strong>{{ $comment->author_name }}</strong>

        <p>{{ $comment->body }}</p>

        <button class="btn-danger delete-comment" data-comment-id="{{ $comment->id }}">
            Delete
        </button>
    </div>
@empty
    <p class="muted">No comments yet.</p>
@endforelse

<div class="pagination-links">
    {{ $comments->links() }}
</div>