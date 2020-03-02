@extends('layouts.default')

@section('title', 'Edit Project')

@section('content')

    <h1>Editing <span class="text-muted">'{{$project->title}}'</span></h1>

<form method="POST" action="{{ route('project-update', [$project->id])}}">
    <input name="_method" type="hidden" value="PATCH">
    @csrf

    <label for="">Project Name</label>
    <input class="form-control" id="title" name="title" type="text" value="{{$project->title}}"/>

    <div class="form-group">
        <label for="intro">Intro</label>
        <textarea class="form-control" id="intro" name="intro">{{$project->intro}}</textarea>
    </div>

    <div class="form-group">
        <label for="full_detail">Detailed Explanation</label>
        <textarea class="form-control" id="full_detail" name="full_detail">{{$project->full_detail}}</textarea>
    </div>

    <div class="form-row">
        <div class="col">

            <div class="form-group">
                <label for="project_url">Project URL</label>
                <input class="form-control" id="project_url" name="project_url" type="text" value="{{$project->project_url}}"/>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="project_repo">Project Repo</label>
                <input class="form-control" id="project_repo" name="project_repo" type="text" value="{{$project->project_repo}}"/>
            </div>
        </div>

    </div>

    <button class="btn btn-lg btn-primary text-center" type="submit">Edit Project</button>

</form>
<hr/>
<h4 class="mt-3">Add Project Gallery Images</h4>
<div class="row mt-3">
    <div class="col-md-12">
        <form action="{{url('multi-upload')}}"
              class="dropzone" id="addImages">
            @csrf
            <input type="hidden" name="project_id" value="{{$project->id}}">

        </form>
    </div>

</div>

@if($project->images->count() > 0)
    <h4 class="mt-3">Curent Images</h4>
@endif
<div class="row mb-3">

                @foreach($project->images as $image)

                    <div class="col-3">
                        <a href="/images/{{$image->file_name}}" target="_blank">
                            <img class="img-fluid" src="/images/{{$image->file_name}}">
                        </a>

                        <div class="card card-body">

                                @if($image->description == null)
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="{{'#'.$image->id}}">Add Caption</button>
                                    <div id="{{$image->id}}" class="collapse">

                                        <form class="mt-2" method="POST" action="{{ route('image-update', [$image->id])}}">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{$project->id}}" />

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="main_img" class="form-check-input" value="">Set to Main Image
                                                </label>
                                            </div>

                                            <div class="form-group">
                                            <textarea class="form-control" name="description"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success">Save</button>

                                        </form>
                                    </div>
                                @else

                            <h6>Current Caption:</h6><p>{{$image->description}}</p>
                        <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="{{'#'.$image->id}}">Edit Description</button>
                        <div id="{{$image->id}}" class="collapse">


                                <form class="mt-2" method="POST" action="{{ route('image-update', [$image->id])}}">
                                    @csrf

                                    <input type="hidden" name="project_id" value="{{$project->id}}" />
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="main_img" class="form-check-input" {{ $image->main_img == 1 ? 'checked' : '' }}>Set to Main Image
                                        </label>
                                    </div>

                                    <div class="form-group">
                                    <textarea class="form-control" name="description">{{$image->description}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                </form>
                            </div>

                            @endif

                        </div>

                    </div>

                @endforeach

    </div>
    </div>


@endsection
