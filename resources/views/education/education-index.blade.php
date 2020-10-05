@extends('layouts.default')

@section('title', 'Manage Education')
@section('content')
    <h1><i class="fas fa-user-graduate mb-3"></i> Manage Education Endpoints</h1>

<hr/>
    <h2><i class="fas fa-school"></i> Schools <a class="btn btn-sm btn-dark" href="/education/create-education">Create School</a></h2>
    <div class="row">
    @foreach($education as $edu)

    <div class="col-md-6 col-lg-6 mt-3 text-center">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$edu->school_name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$edu->start_month_year_format}} - {{$edu->end_month_year_format}}</h6>
                <img class="img-responsive thumbnail" src="../../images/education/{{ $edu->logo}}">
                <a class="btn btn-sm btn-dark" href="/education/edit-education/{{$edu->id}}">Edit</a>
            </div>
        </div>
    </div>

    @endforeach
    </div>

    <hr/>
    @include('education.award.index-awards')
    
@endsection
