@extends('layouts.default')

@section('title', 'Edit Education: '.$education->school_name)

@section('content')

    <h1>Editing <span class="text-muted">'{{$education->school_name}}'</span></h1>

    <form method="POST" action="{{ route('/education/education-update', [$education->id])}}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <input type="hidden" name="personal_id" value="{{$personal_id}}"/>

        <div class="form-group">
        <label for="">School Name</label>
        <input class="form-control" id="school_name" name="school_name" type="text" value="{{$education->school_name}}"/>
        </div>

        <div class="form-group">

            <label>Current Logo:</label>
            <img class="img-responsive thumbnail" src="../../images/education/{{ $education->logo}}">
        </div>

        <div class="form-group">

            <label for="profile_image">School Logo</label>
            <input type="file" name="image_file" id="image_file" onchange="readURL(this);"/>
            <input type="text" type="hidden" class="img_name" name="logo">
        </div>

        <div id="image_preview">
            <img id="img_logo" class="img-fluid img-thumbnail" src="#" alt="uploaded image">
        </div>

        <div class="form-group">
            <label for="intro">Description</label>
            <textarea class="form-control" id="details" name="details">{{$education->details}}</textarea>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="start_month_year">Start Month & Year</label>
                    <input class="form-control" id="start_month_year_preformat" name="start_month_year_preformat" type="month" value="{{$education->start_month_year_preformat}}"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_month_year">End Month & Year</label>
                    <input class="form-control" id="end_month_year_preformat" name="end_month_year_preformat" type="month" value="{{$education->end_month_year_preformat}}"/>
                </div>
            </div>

        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Update Education</button>

        <a class="btn btn-lg btn-success" href="/education"><i class="fas fa-user-graduate"></i> Back to Education</a>

    </form>

@include('education.degree.index-degree')
@include('education.degree.index-certificate')
@include('education.degree.create-degree-certificate')

@endsection

@section('scripts')
    <script  src="/js/image_upload.js"></script>
@endsection
