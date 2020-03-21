@extends('layouts.default')

@section('title', 'Manage Education')
@section('content')
    <h1><i class="fas fa-briefcase mb-3"></i> Manage Work History Endpoints</h1>

    <hr/>
    <h2><i class="fas fa-user-tie"></i> Work History <a class="btn btn-sm btn-dark" href="/work/create-work">Create Work</a></h2>
    <div class="row">
        @foreach($work as $history)

            <div class="col-md-6 col-lg-6 mt-3 text-center">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$history->company_name}}</h5>
                        <h6 class="card-title">{{$history->role}}</h6>

                        <h6 class="card-subtitle mb-2 text-muted">{{$history->start_date_month_year_format}} - {{$history->end_date_month_year_format}}</h6>
                        <a class="btn btn-sm btn-dark" href="/work/edit-work/{{$history->id}}">Edit</a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <hr/>
    <h2><i class="fas fa-code"></i> Skills <a class="btn btn-sm btn-dark" href="/work/skills/create-skill">Add Skill</a></h2>

    <div class="row">
{{--        @foreach($awards as $award)--}}


            <div class="col-md-6 col-lg-6 mt-3 text-center">
                <div class="card" style="">
                    <div class="card-body">
{{--                        <h5 class="card-title">{{$award->award_name}}</h5>--}}
{{--                        <h6 class="card-subtitle mb-2 text-muted">{{$award->date_range}}</h6>--}}
{{--                        <a class="btn btn-sm btn-dark" href="/education/award/edit-award/{{$award->id}}">Edit</a>--}}
                    </div>
                </div>
            </div>

{{--        @endforeach--}}
    </div>

@endsection
