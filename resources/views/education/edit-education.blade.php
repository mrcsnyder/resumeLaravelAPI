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
            <img class="img-responsive thumbnail" src="../../images/{{ $education->logo}}">
        </div>

        <div class="form-group">

        <label>Update Logo</label>
        <div class="form-group">
            <input class="form-control" type="file" name="logo" id="logo" onchange="readURL(this);"/>
        </div>

        <div id="image_preview">
            <img id="img_logo" class="img-responsive thumbnail" src="#" alt="uploaded logo">
        </div>
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

    @if($degrees->count() > 0)
        <hr>
    <h2>Degrees</h2>
        <div class="row">
    @foreach($degrees as $degree)

            <div class="col-md-6 col-lg-6 mt-3 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$degree->major}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Completed: {{$degree->completed_month_year_format}}</h6>
                    <p class="card-text">{{$degree->gpa}} GPA, {{$degree->honors_info}}</p>
                    <a href="/education/degree/edit-degree-certificate/{{$degree->id}}" class="card-link">Edit Degree</a>
                </div>
            </div>
            </div>

    @endforeach
        </div>

    <hr>
    @endif

    @if($certificates->count() > 0)
    <h2>Certificates</h2>
    <div class="row">
    @foreach($certificates as $cert)


            <div class="col-md-6 col-lg-6 mt-3 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$cert->major}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Completed: {{$cert->completed_month_year_format}}</h6>
                    <p class="card-text">{{$cert->honors_info}}</p>
                    <a href="/education/degree/edit-degree-certificate/{{$cert->id}}" class="card-link">Edit Certificate</a>


                </div>
            </div>
            </div>


    @endforeach
    </div>

    @endif

    <hr>


    <h1>Add Degree or Certificate</h1>
    <form class="mb-3" method="POST" action="{{ route('/education/create-certificate-diploma') }}">
        @csrf

        <input class="form-control" id="education_id" value="{{$education->id}}" name="education_id" type="hidden"/>

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="degree_or_certificate">Degree or Certificate</label>
                    <select class="form-control" id="degree_or_certificate" name="degree_or_certificate">
                        <option selected>Choose Degree or Certificate</option>
                        <option value="degree">Degree</option>
                        <option value="certificate">Certificate</option>
                    </select>
                </div>
            </div>

            <div class="col">
        <div class="form-group">
            <label for="major">Major</label>
            <input class="form-control" id="major" name="major" type="text"/>
        </div>
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="gpa">GPA</label>
                    <input class="form-control" id="gpa" name="gpa" step="0.01" value="0.00" placeholder="0.00" type="number"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="completed_month_year">Completion Month & Year</label>
                    <input class="form-control" id="completed_month_year_preformat" name="completed_month_year_preformat" type="month"/>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label for="honors_info">Honors Info</label>
            <textarea class="form-control" id="honors_info" name="honors_info"></textarea>
        </div>

        <button class="btn btn-lg btn-primary text-center" type="submit">Create Degree or Certificate</button>

        <a class="btn btn-lg btn-success" href="/education"><i class="fas fa-user-graduate"></i> Back to Education</a>

    </form>

@endsection


@section('scripts')
    <script  src="/js/image_upload.js"></script>
@endsection
