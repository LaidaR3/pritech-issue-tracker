@extends('layouts.app')

@section('content')

<h2>Edit Project</h2>

<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    @include('projects.form')

    <button type="submit">Update</button>
    <a href="{{ route('projects.index') }}">Back</a>
</form>

@endsection