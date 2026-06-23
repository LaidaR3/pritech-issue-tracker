@extends('layouts.app')

@section('content')

<h2>Create Issue</h2>

<form action="{{ route('issues.store') }}" method="POST">
    @csrf

    @include('issues.form')

    <button type="submit">Save</button>
</form>

@endsection