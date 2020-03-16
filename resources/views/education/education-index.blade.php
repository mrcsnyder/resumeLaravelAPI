@extends('layouts.default')

@section('title', 'Manage Education')
@section('content')
    <h1><i class="fas fa-user-graduate"></i> Manage Education Endpoints</h1>

    @foreach($education as $edu)

        <p><img class="img-responsive thumbnail" src="../../images/{{ $edu->logo}}"> <a href="/education/edit-education/{{$edu->id}}">{{$edu->school_name}}</a></p>

    @endforeach
@endsection
