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

    <div id="issues-table">
        @include('issues.table')
    </div>

    <script>
        let searchTimer;

        document.getElementById('search-input').addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(() => {
                const form = this.closest('form');
                const params = new URLSearchParams(new FormData(form));

                fetch(`/issues?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('issues-table').innerHTML = html;
                    });
            }, 400);
        });
    </script>

@endsection