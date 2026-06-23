@extends('layouts.app')

@section('content')

<a href="{{ route('projects.index') }}" class="btn">Projects</a>
<a href="{{ route('issues.index') }}" class="btn">Issues</a>

<h2>Tags</h2>

<form action="{{ route('tags.store') }}" method="POST">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror

    <br><br>

    <label>Color</label><br>
    <input type="text" name="color" value="{{ old('color') }}" placeholder="example: red or #ff0000">
    @error('color') <p class="error">{{ $message }}</p> @enderror

    <br><br>

    <button type="submit">Create Tag</button>
</form>

<br>

<table>
    <tr>
        <th>Name</th>
        <th>Color</th>
    </tr>

    @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->name }}</td>
            <td>{{ $tag->color }}</td>
        </tr>
    @endforeach
</table>

@endsection