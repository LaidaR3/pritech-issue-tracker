@extends('layouts.app')

@section('content')

<h2>Create Project</h2>

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    @include('projects.form')

    <button type="submit">Save</button>
    <a href="{{ route('projects.index') }}">Back</a>
</form>

@endsection