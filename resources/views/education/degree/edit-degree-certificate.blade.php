@extends('layouts.default')

@section('title', 'Edit '.$degree->degree_or_certificate)

@section('content')

    <h1>Editing <span class="text-muted">'{{$degree->major}}' @ {{$degree->education->school_name}}</span></h1>

    <form class="mb-3" method="POST" action="{{ route('/education/degree/degree-certificate-update', [$degree->id])}}">
        <input name="_method" type="hidden" value="PATCH">
        @csrf

        <input class="form-control" id="education_id" value="{{$degree->education_id}}" name="education_id" type="hidden"/>

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="degree_or_certificate">Degree or Certificate</label>
                    <select class="form-control" id="degree_or_certificate" name="degree_or_certificate">
                        <option {{ ($degree->degree_or_certificate != 'degree' || $degree->degree_or_certificate != 'certificate') ? 'selected' : '' }}>Choose Degree or Certificate</option>
                        <option value="degree" {{ $degree->degree_or_certificate == 'degree' ? 'selected' : '' }}>Degree</option>
                        <option value="certificate" {{ $degree->degree_or_certificate == 'certificate' ? 'selected' : '' }}>Certificate</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="major">Major</label>
                    <input class="form-control" id="major" value="{{$degree->major}}" name="major" type="text"/>
                </div>
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="gpa">GPA</label>
                    <input class="form-control" id="gpa" name="gpa" step="0.01" value="{{$degree->gpa}}" type="number"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="completed_month_year_preformat">Completion Month & Year</label>
                    <input class="form-control" id="completed_month_year_preformat" value="{{$degree->completed_month_year_preformat}}" name="completed_month_year_preformat" type="month"/>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label for="honors_info">Honors Info</label>
            <textarea class="form-control" id="honors_info" name="honors_info">{{$degree->honors_info}}</textarea>
        </div>

        <button class="btn btn-lg btn-primary text-center" type="submit">Edit Degree or Certificate</button>
        <a class="btn btn-lg btn-success" href="/education/edit-education/{{$degree->education->id}}">Back to {{$degree->education->school_name}} Edit</a>
    </form>

 @endsection
