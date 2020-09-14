@extends('layouts.default')
@section('title', 'Create Skill')
@section('content')

    <h1>Create Skill</h1>
    <form class="mb-3" method="POST" action="{{ route('/work/skill/create-skill') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$personal_id}}" name="personal_id"/>

        <div class="form-group">
            <label for="skill">Skill</label>
            <input class="form-control" id="skill" name="skill" type="text"/>
        </div>

        <div class="form-row">
            <div class="col">

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    <option>Choose Skill</option>
                    <option value="coding">Coding</option>
                    <option value="methods_devops">Methodologies/DevOps</option>
                    <option value="software">Software</option>
                    <option value="operating_systems">OS</option>
                    <option value="business">Business</option>
                </select>
            </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="">Rating</label>
                    <input class="form-control" id="rating" name="rating" step="0.1" type="number"/>
                </div>
            </div>
        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Create Skill</button>

    </form>

@endsection

@section('scripts')

@endsection
