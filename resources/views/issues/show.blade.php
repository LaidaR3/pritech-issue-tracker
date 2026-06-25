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

    <div id="comment-errors"></div>

    <form id="comment-form" class="comment-form" method="POST" action="{{ route('comments.store', $issue) }}" novalidate>
        @csrf
        <input type="text" name="author_name" placeholder="Your name">
        <div id="author_name_error" class="error"></div>

        <textarea name="body" placeholder="Write a comment..."></textarea>
        <div id="body_error" class="error"></div>

        <button type="button" id="add-comment-btn">Add Comment</button>
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
                        'Accept': 'application/json'
                    }
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

        document.getElementById('add-comment-btn').addEventListener('click', function () {
            const form = document.getElementById('comment-form');
            const formData = new FormData(form);
            const errorBox = document.getElementById('comment-errors');

            // Clear previous validation errors
            document.getElementById('author_name_error').innerHTML = '';
            document.getElementById('body_error').innerHTML = '';
            errorBox.innerHTML = '';

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(async response => {
                    const data = await response.json();

                    if (response.status === 422) {
                        if (data.errors.author_name) {
                            document.getElementById('author_name_error').innerHTML =
                                data.errors.author_name[0];
                        }

                        if (data.errors.body) {
                            document.getElementById('body_error').innerHTML =
                                data.errors.body[0];
                        }

                        return;

                        errorBox.innerHTML = errors;
                        return;
                    }

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