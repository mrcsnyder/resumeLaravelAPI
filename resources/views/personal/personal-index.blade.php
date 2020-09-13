@extends('layouts.default')

@section('title', 'Manage Personal Details')
@section('content')
    <h1><i class="fas fa-user"></i> Manage Personal Details Endpoint</h1>
    <hr/>
    <h2>Personal Details @if(empty($personal))<a class="btn btn-sm btn-dark" href="/personal/create-personal">Create Personal Details</a>@endif</h2>
    @if(!empty($personal))
    <div class="row">

            <div class="col-md-6 col-lg-6 mt-3 mb-3 text-center">

                <div class="card">
                    <div class="card-body">
                        <img src="/images/{{$personal->profile_image}}" id="portrait-img" alt="{{$personal->name}}" class="img-fluid portrait-about mx-auto d-block rounded-circle">
                        <h5 class="card-title">{{$personal->name}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$personal->current_role}}</h6>
                        <a class="btn btn-sm btn-dark" href="/personal/edit-personal">Edit</a>
                    </div>
                </div>
            </div>

    </div>
    @endif
@endsection
