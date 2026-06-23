@extends('layouts.app')

@section('content')

<a href="{{ route('projects.index') }}" class="btn">Projects</a>
<a href="{{ route('issues.create') }}" class="btn">Create Issue</a>

<br><br>

<form method="GET" action="{{ route('issues.index') }}">
    <select name="status">
        <option value="">All Statuses</option>
        <option value="open" @selected(request('status') == 'open')>Open</option>
        <option value="in_progress" @selected(request('status') == 'in_progress')>In Progress</option>
        <option value="closed" @selected(request('status') == 'closed')>Closed</option>
    </select>

    <select name="priority">
        <option value="">All Priorities</option>
        <option value="low" @selected(request('priority') == 'low')>Low</option>
        <option value="medium" @selected(request('priority') == 'medium')>Medium</option>
        <option value="high" @selected(request('priority') == 'high')>High</option>
    </select>

    <select name="tag_id">
        <option value="">All Tags</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(request('tag_id') == $tag->id)>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
    <a href="{{ route('issues.index') }}">Clear</a>
</form>

<br>
<table>
    <tr>
        <th>Title</th>
        <th>Project</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Due Date</th>
        <th>Actions</th>
    </tr>

    @foreach($issues as $issue)
        <tr>
            <td>{{ $issue->title }}</td>
            <td>{{ $issue->project->name }}</td>
            <td>{{ $issue->status }}</td>
            <td>{{ $issue->priority }}</td>
            <td>{{ $issue->due_date }}</td>
            <td>
                <a href="{{ route('issues.show', $issue) }}">View</a>
                <a href="{{ route('issues.edit', $issue) }}">Edit</a>

                <form action="{{ route('issues.destroy', $issue) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection