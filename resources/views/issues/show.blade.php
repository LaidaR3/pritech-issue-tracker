@extends('layouts.app')

@section('content')

<h2>{{ $issue->title }}</h2>

<p><strong>Project:</strong> {{ $issue->project->name }}</p>
<p><strong>Description:</strong> {{ $issue->description }}</p>
<p><strong>Status:</strong> {{ $issue->status }}</p>
<p><strong>Priority:</strong> {{ $issue->priority }}</p>

<p>
    <strong>Tags:</strong>

    @forelse($issue->tags as $tag)
        {{ $tag->name }}
    @empty
        No tags
    @endforelse
</p>

<p><strong>Due Date:</strong> {{ $issue->due_date }}</p>

<a href="{{ route('issues.index') }}">Back</a>

@endsection