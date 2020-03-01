@extends('layouts.default')

@section('title', 'All Projects')
@section('content')
<h1>All Projects</h1>

@foreach($projects as $project)

    <p><a href="/edit-project/{{$project->id}}">{{$project->title}}</a></p>

@endforeach
@endsection
