@extends('layouts.app')

@section('content')

<div class="page-actions">
    <a href="{{ route('projects.index') }}" class="btn">Projects</a>
    <a href="{{ route('issues.index') }}" class="btn">Issues</a>
</div>

<h2>Manage Tags</h2>

<div class="tag-page">
    <div class="tag-card">
        <h3>Create Tag</h3>

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label>Color</label>
            <input type="text" name="color" value="{{ old('color') }}" placeholder="#2563eb">
            @error('color') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">Create Tag</button>
        </form>
    </div>

    <div class="tag-card">
        <form method="GET" action="{{ route('tags.index') }}" class="tag-search">
            <input type="text" name="search" id="tag-search" value="{{ request('search') }}" placeholder="Search tags...">

            <button type="submit">Search</button>

            <a href="{{ route('tags.index') }}" class="btn btn-light">Clear</a>
        </form>

        <div class="tag-list">
            @foreach($tags as $tag)
                <div class="tag-row">
                    <span>{{ $tag->name }}</span>

                    <span class="tag-color">
                        <span class="color-dot" style="background: {{ $tag->color }}"></span>
                        {{ $tag->color }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
let tagSearchTimer;

document.getElementById('tag-search').addEventListener('input', function () {
    clearTimeout(tagSearchTimer);

    tagSearchTimer = setTimeout(() => {
        this.form.submit();
    }, 500);
});
</script>

@endsection