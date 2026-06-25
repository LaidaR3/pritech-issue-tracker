@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div>
            <h2>{{ $issue->title }}</h2>
            <p class="muted">Issue details, tags and comments</p>
        </div>

        <a href="{{ route('issues.index') }}" class="btn btn-light">
            Back to Issues
        </a>
    </div>

    <div class="card">
        <p><strong>Project:</strong> {{ $issue->project->name }}</p>
        <p><strong>Description:</strong> {{ $issue->description }}</p>

        <p>
            <strong>Status:</strong>
            <span class="badge">{{ str_replace('_', ' ', ucfirst($issue->status)) }}</span>
        </p>

        <p>
            <strong>Priority:</strong>
            <span class="badge">{{ ucfirst($issue->priority) }}</span>
        </p>

        <p><strong>Due Date:</strong> {{ $issue->due_date ?? 'No due date' }}</p>
    </div>

    <p><strong>Tags:</strong></p>

    <div class="tag-grid" id="tags-list">
        @foreach($tags as $tag)
            <label class="tag-option {{ $issue->tags->contains($tag->id) ? 'tag-selected' : '' }}">
                <input type="checkbox" class="tag-checkbox" data-tag-id="{{ $tag->id }}"
                    @checked($issue->tags->contains($tag->id))>
                {{ $tag->name }}
            </label>
        @endforeach
    </div>

    <p id="tag-message" class="success-message"></p>

    <hr>

    <h3>Comments</h3>

    <form id="comment-form" class="comment-form">
        @csrf

        <input type="text" name="author_name" placeholder="Your name" required>

        <textarea name="body" placeholder="Write a comment..." required></textarea>

        <button type="submit">Add Comment</button>
    </form>

    <div id="comments-list" class="comments-list"></div>

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

        

    

        function loadComments(url = '/issues/{{ $issue->id }}/comments') {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('comments-list').innerHTML = html;
                });
        }

        loadComments();

        document.getElementById('comment-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

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
                    form.reset();
                    loadComments();
                });
        });

        document.addEventListener('click', function (e) {

            if (e.target.classList.contains('delete-comment')) {
                const commentId = e.target.dataset.commentId;

                fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(() => {
                        loadComments();
                    });
            }

            if (e.target.matches('.pagination a')) {
                e.preventDefault();
                loadComments(e.target.href);
            }
        });
    </script>

@endsection