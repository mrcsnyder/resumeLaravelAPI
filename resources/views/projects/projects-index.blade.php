@extends('layouts.default')

@section('title', 'Manage Projects')
@section('content')
<h1>Manage Projects</h1>

@foreach($projects as $project)

    <p><a href="/projects/edit-project/{{$project->id}}">{{$project->title}}</a></p>

@endforeach
@endsection
