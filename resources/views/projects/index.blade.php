@extends('layouts.app')

@section('content')

    <a href="{{ route('projects.create') }}" class="btn">Create Project</a>

    <br><br>

    <form method="GET" action="{{ route('projects.index') }}">
        <input type="text" name="search" id="project-search" value="{{ request('search') }}"
            placeholder="Search projects...">

        <button type="submit">Search</button>

        <a href="{{ route('projects.index') }}" class="btn btn-light">
            Clear
        </a>
    </form>

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
                <td class="actions">
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-light action-btn">
                        View
                    </a>

                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-light action-btn">
                        Edit
                    </a>

                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-danger action-btn">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection