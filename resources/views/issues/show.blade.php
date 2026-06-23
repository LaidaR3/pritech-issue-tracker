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
            <input
                type="checkbox"
                class="tag-checkbox"
                data-tag-id="{{ $tag->id }}"
                @checked($issue->tags->contains($tag->id))
            >
            {{ $tag->name }}
        </label>
        <br>
    @endforeach
</div>

<p id="tag-message"></p>

<p><strong>Due Date:</strong> {{ $issue->due_date }}</p>

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

@endsection