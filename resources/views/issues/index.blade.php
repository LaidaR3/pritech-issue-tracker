@extends('layouts.app')

@section('content')

    <a href="{{ route('projects.index') }}" class="btn">Projects</a>
    <a href="{{ route('issues.create') }}" class="btn">Create Issue</a>

    <br><br>

   <form method="GET" action="{{ route('issues.index') }}" class="filter-form">
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
        <input type="text" name="search" id="search-input" value="{{ request('search') }}" placeholder="Search issues...">

        <div class="filter-actions">
            <button type="submit">Filter</button>
            <a href="{{ route('issues.index') }}" class="btn btn-light">Clear</a>
        </div>
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
                    <div class="actions">
                        <a href="{{ route('issues.show', $issue) }}" class="btn-light action-btn">
                            View
                        </a>

                        <a href="{{ route('issues.edit', $issue) }}" class="btn-light action-btn">
                            Edit
                        </a>

                        <form action="{{ route('issues.destroy', $issue) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-danger action-btn">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        let searchTimer;

        document.getElementById('search-input').addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    </script>

@endsection