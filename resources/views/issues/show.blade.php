@extends('layouts.app')

@section('content')

    <h2>{{ $issue->title }}</h2>

    <p><strong>Project:</strong> {{ $issue->project->name }}</p>
    <p><strong>Description:</strong> {{ $issue->description }}</p>
    <p><strong>Status:</strong> {{ $issue->status }}</p>
    <p><strong>Priority:</strong> {{ $issue->priority }}</p>

    <p><strong>Tags:</strong></p>

    <div id="tags-list">
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" class="tag-checkbox" data-tag-id="{{ $tag->id }}"
                    @checked($issue->tags->contains($tag->id))>
                {{ $tag->name }}
            </label>
            <br>
        @endforeach
    </div>

    <p id="tag-message"></p>

    <p><strong>Due Date:</strong> {{ $issue->due_date }}</p>

    <hr>

    <h3>Comments</h3>

    <form id="comment-form">
        @csrf

        <input type="text" name="author_name" placeholder="Your name" required>

        <br><br>

        <textarea name="body" placeholder="Write a comment..." required></textarea>

        <br><br>

        <button type="submit">Add Comment</button>
    </form>

    <br>

    <div id="comments-list">
        @foreach($issue->comments as $comment)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong>{{ $comment->author_name }}</strong>

                <p>{{ $comment->body }}</p>

                <button class="delete-comment" data-comment-id="{{ $comment->id }}">
                    Delete
                </button>
            </div>
        @endforeach
    </div>

    <a href="{{ route('issues.index') }}">Back</a>

    <script>
        document.querySelectorAll('.tag-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const tagId = this.dataset.tagId;
                const issueId = "{{ $issue->id }}";
                const isChecked = this.checked;

                fetch(`/issues/${issueId}/tags/${tagId}`, {
                    method: isChecked ? 'POST' : 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('tag-message').innerText = data.message;
                    });
            });
        });
    </script>
<script>
document.querySelectorAll('.delete-comment').forEach(button => {

    button.addEventListener('click', function() {

        const commentId = this.dataset.commentId;

        fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => {
            location.reload();
        });
    });

});
</script>

    <script>
        document.getElementById('comment-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/issues/{{ $issue->id }}/comments', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json())
                .then(() => {
                    location.reload();
                });
        });
    </script>

@endsection