@extends('layouts.app')

@section('content')

<a href="{{ route('projects.create') }}" class="btn">Create Project</a>

<br><br>

<table>
    <tr>
        <th>Name</th>
        <th>Start Date</th>
        <th>Deadline</th>
        <th>Actions</th>
    </tr>

    @foreach($projects as $project)
        <tr>
            <td>{{ $project->name }}</td>
            <td>{{ $project->start_date }}</td>
            <td>{{ $project->deadline }}</td>
            <td>
                <a href="{{ route('projects.show', $project) }}">View</a>
                <a href="{{ route('projects.edit', $project) }}">Edit</a>

                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection