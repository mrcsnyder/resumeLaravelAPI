@extends('layouts.default')
@section('title', 'Manage Projects')
@section('content')

    <h1><i class="fas fa-laptop-code mb-3"></i> Manage Projects Endpoint</h1>

    <a class="btn btn-sm btn-dark mb-3" href="/projects/create-project">Create Project</a>

@foreach($projects as $project)

    <div>
        <a href="/projects/edit-project/{{$project->id}}">{{$project->title}}</a>

    <form class="d-inline" method="POST" action="{{ route('/projects/project-delete', [$project->id])}}">
        <input name="_method" type="hidden" value="DELETE"/>
        @csrf
        <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
    </form>
        <br/>
    </div>

@endforeach

@endsection
