@extends('layouts.app')

@section('content')

<h2>{{ $project->name }}</h2>

<p>{{ $project->description }}</p>
<p>Start Date: {{ $project->start_date }}</p>
<p>Deadline: {{ $project->deadline }}</p>

<a href="{{ route('projects.index') }}" class="btn btn-light">
    Back to Projects
</a>

<h3>Issues</h3>

@if($project->issues->count())
    <ul>
        @foreach($project->issues as $issue)
            <li>{{ $issue->title }} - {{ $issue->status }}</li>
        @endforeach
    </ul>
@else
    <p>No issues yet.</p>
@endif

@endsection