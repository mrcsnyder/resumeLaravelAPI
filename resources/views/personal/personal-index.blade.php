@extends('layouts.default')

@section('title', 'Manage Personal Details')
@section('content')
    <h1><i class="fas fa-user"></i> Manage Personal Details Endpoint</h1>
    <hr/>
    <h2>Personal Details @if($personal->count() == 0)<a class="btn btn-sm btn-dark" href="/personal/create-personal">Create Personal Details</a>@endif</h2>
    <div class="row">
        @foreach($personal as $person)

            <div class="col-md-6 col-lg-6 mt-3 mb-3 text-center">

                <div class="card">
                    <div class="card-body">
                        <img src="/images/{{$person->profile_image}}" id="portrait-img" alt="{{$person->name}}" class="img-fluid portrait-about mx-auto d-block rounded-circle">
                        <h5 class="card-title">{{$person->name}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$person->current_role}}</h6>
                        <a class="btn btn-sm btn-dark" href="/personal/edit-personal/{{$person->id}}">Edit</a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
