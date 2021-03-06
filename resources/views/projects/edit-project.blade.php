@extends('layouts.default')

@section('title', 'Edit Project | '.$project->title)

@section('content')

<h1>Editing <span class="text-muted">'{{$project->title}}'</span></h1>

<form method="POST" action="{{ route('/projects/project-update', [$project->id])}}">
    <input name="_method" type="hidden" value="PATCH">
    @csrf
    <input type="hidden" value="{{$personal_id}}" name="personal_id"/>
    <label for="">Project Name (Name &amp; One Line Description)</label>
    <input class="form-control" id="title" name="title" type="text" value="{{$project->title}}"/>

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
    <a class="btn btn-lg btn-success" href="/projects"><i class="fas fa-laptop-code"></i> Back to Projects</a>

</form>
<hr/>

@include('projects.create-project-images')
@include('projects.edit-project-images')

@endsection
