@extends('layouts.default')

@section('title', 'Edit Work')

@section('content')

    <h1>Editing <span class="text-muted">'{{$work->company_name}}'</span></h1>

    <form class="mb-3" method="POST" action="{{ route('/work/work-update', [$work->id])}}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <input type="hidden" name="personal_id" value="{{$personal_id}}"/>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
            <label for="">Company Name</label>
            <input class="form-control" id="company_name" name="company_name" type="text" value="{{$work->company_name}}"/>
        </div>
            </div>

        <div class="col">
        <div class="form-group">
            <label for="">Role</label>
            <input class="form-control" id="role" name="role" type="text" value="{{$work->role}}"/>
        </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea class="form-control" id="description" name="description">{{$work->description}}</textarea>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="start_month_year">Start Month & Year</label>
                    <input class="form-control" id="start_date_month_year_preformat" name="start_date_month_year_preformat" type="month" value="{{$work->start_date_month_year_preformat}}"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_month_year">End Month & Year (Leave Blank if Still Employed)</label>
                    <input class="form-control" id="end_date_month_year_preformat" name="end_date_month_year_preformat" type="month" value="{{$work->end_date_month_year_preformat}}"/>
                </div>
            </div>

        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Update Work</button>

    </form>

    <a class="btn btn-md btn-success" href="/work"><i class="fas fa-briefcase"></i> Back to Work</a>

@endsection


@section('scripts')

@endsection
