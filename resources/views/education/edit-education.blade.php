@extends('layouts.default')

@section('title', 'Edit Education')

@section('content')

    <h1>Editing <span class="text-muted">'{{$education->school_name}}'</span></h1>

    <form method="POST" action="{{ route('/education/education-update', [$education->id])}}">
        <input name="_method" type="hidden" value="PATCH">
        @csrf

        <label for="">School Name</label>
        <input class="form-control" id="school_name" name="school_name" type="text" value="{{$education->school_name}}"/>

        <div class="form-group">
            <label for="intro">Description</label>
            <textarea class="form-control" id="details" name="details">{{$education->details}}</textarea>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="start_month_year">Start Month & Year</label>
                    <input class="form-control" id="start_month_year" name="start_month_year" type="text" value="{{$education->start_month_year}}"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_month_year">End Month & Year</label>
                    <input class="form-control" id="end_month_year" name="end_month_year" type="text" value="{{$education->end_month_year}}"/>
                </div>
            </div>

        </div>

        <button class="btn btn-lg btn-primary text-center" type="submit">Edit Education</button>

    </form>
{{--    <hr/>--}}
{{--    <h4 class="mt-3">Add Project Gallery Images</h4>--}}
{{--    <div class="row mt-3">--}}
{{--        <div class="col-md-12">--}}
{{--            <form action="{{url('multi-upload')}}"--}}
{{--                  class="dropzone" id="addImages">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="project_id" value="{{$project->id}}">--}}

{{--            </form>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    @if($project->images->count() > 0)--}}
{{--        <h4 class="mt-3">Current Images</h4>--}}
{{--    @endif--}}
{{--    <div class="row mb-3">--}}

{{--        @foreach($project->images as $image)--}}

{{--            <div class="col-md-6 col-lg-3 mt-3 text-center">--}}
{{--                <a href="/images/{{$image->file_name}}" target="_blank">--}}
{{--                    <img class="img-fluid mx-auto" src="/images/thmb-{{$image->file_name}}">--}}
{{--                </a>--}}

{{--                <div class="card card-body">--}}

{{--                    @if($image->description == null)--}}
{{--                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="{{'#'.$image->id}}">Add Caption</button>--}}
{{--                        <div id="{{$image->id}}" class="collapse">--}}

{{--                            <form class="mt-2" method="POST" action="{{ route('image-update', [$image->id])}}">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="project_id" value="{{$project->id}}" />--}}

{{--                                <div class="form-check">--}}
{{--                                    <label class="form-check-label">--}}
{{--                                        <input type="checkbox" name="main_img" class="form-check-input" value="">Set to Main Image--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                                <div class="form-group">--}}
{{--                                    <textarea class="form-control" name="description"></textarea>--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="btn btn-sm btn-success">Save</button>--}}

{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @else--}}

{{--                        <h6>Current Caption:</h6><p>{{$image->description}}</p>--}}
{{--                        <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="{{'#'.$image->id}}">Edit Description</button>--}}
{{--                        <div id="{{$image->id}}" class="collapse">--}}


{{--                            <form class="mt-2" method="POST" action="{{ route('image-update', [$image->id])}}">--}}
{{--                                @csrf--}}

{{--                                <input type="hidden" name="project_id" value="{{$project->id}}" />--}}


{{--                                <div class="form-check">--}}
{{--                                    <input type="checkbox" name="main_img" value="{{$image->main_img}}" {{ $image->main_img == 1 ? 'checked' : '' }}>--}}
{{--                                    <label class="form-check-label" for="main_img">Set to Main Image</label>--}}
{{--                                </div>--}}



{{--                                <div class="form-group">--}}
{{--                                    <textarea class="form-control" name="description">{{$image->description}}</textarea>--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="btn btn-sm btn-success">Save</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                    @endif--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        @endforeach--}}

{{--    </div>--}}

@endsection
