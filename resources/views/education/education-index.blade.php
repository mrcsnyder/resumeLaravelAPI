@extends('layouts.default')

@section('title', 'Manage Education')
@section('content')
    <h1>Manage Education</h1>

    @foreach($education as $edu)

        <p><a href="/education/edit-education/{{$edu->id}}">{{$edu->school_name}}</a></p>

    @endforeach
@endsection
