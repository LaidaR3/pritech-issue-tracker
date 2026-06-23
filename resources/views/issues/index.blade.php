@extends('layouts.app')

@section('content')

<a href="{{ route('projects.index') }}" class="btn">Projects</a>
<a href="{{ route('issues.create') }}" class="btn">Create Issue</a>

<br><br>

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