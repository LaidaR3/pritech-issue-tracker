@extends('layouts.app')

@section('content')

<h2>Edit Issue</h2>

<form action="{{ route('issues.update', $issue) }}" method="POST">
    @csrf
    @method('PUT')

    @include('issues.form')

    <button type="submit">Update</button>
</form>

@endsection