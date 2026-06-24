@extends('layouts.app')

@section('content')

    <h2>Create Project</h2>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        @include('projects.form')

        
        <button type="submit" class="btn">
            Save Project
        </button>

        <a href="{{ route('projects.index') }}" class="btn btn-light">
            Cancel
        </a>
    </form>

@endsection