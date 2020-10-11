@extends('layouts.default')
@section('title', 'Create Project')
@section('content')

<h1>Create Project</h1>
<form method="POST" action="{{ route('/projects/create-project') }}">
    @csrf
    <input type="hidden" value="{{$personal_id}}" name="personal_id"/>

    <label for="">Project Name</label>
    <input class="form-control" id="title" name="title" type="text"/>

    <div class="form-group">
        <label for="full_detail">Detailed Explanation</label>
        <textarea class="form-control" id="full_detail" name="full_detail"></textarea>
    </div>

    <div class="form-row">
        <div class="col">

    <div class="form-group">
        <label for="project_url">Project URL</label>
    <input class="form-control" id="project_url" name="project_url" type="text"/>
    </div>
        </div>

            <div class="col">
    <div class="form-group">
        <label for="project_repo">Project Repo</label>
        <input class="form-control" id="project_repo" name="project_repo" type="text"/>
    </div>
            </div>

    </div>

    <button class="btn btn-lg btn-dark text-center" type="submit">Save Project</button>
    <a class="btn btn-lg btn-success" href="/projects"><i class="fas fa-laptop-code"></i> Back to Projects</a>

</form>

 @endsection
