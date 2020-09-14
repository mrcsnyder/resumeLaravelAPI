@extends('layouts.default')

@section('title', 'Editing \''.$skill->skill.'\' Skill')

@section('content')

    <h1>Editing <span class="text-muted">'{{$skill->skill}}'</span> Skill</h1>

    <form class="mb-3" method="POST" action="{{ route('/work/skill/skill-update', [$skill->id])}}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <input type="hidden" value="{{$personal_id}}" name="personal_id"/>

        <div class="form-group">
            <label for="skill">Skill</label>
            <input class="form-control" value="{{$skill->skill}}" id="skill" name="skill" type="text"/>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option {{ ($skill->category != 'coding' || $skill->category != 'methods_devops' || $skill->category != 'software' || $skill->category != 'operating_systems' || $skill->category != 'business') ? 'selected' : '' }}>Choose Skill</option>
                        <option value="coding" {{ $skill->category == 'coding' ? 'selected' : '' }}>Coding</option>
                        <option value="methods_devops" {{ $skill->category == 'methods_devops' ? 'selected' : '' }}>Methodologies/DevOps</option>
                        <option value="software" {{ $skill->category == 'software' ? 'selected' : '' }}>Software</option>
                        <option value="operating_systems" {{ $skill->category == 'operating_systems' ? 'selected' : '' }}>OS</option>
                        <option value="business" {{ $skill->category == 'business' ? 'selected' : '' }}>Business</option>
                    </select>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="">Rating</label>
                    <input class="form-control" id="rating" value="{{$skill->rating}}" name="rating" step="0.1" type="number"/>
                </div>
            </div>
        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Update Skill</button>
        <a class="btn btn-lg btn-success" href="/work"><i class="fas fa-briefcase"></i> Back to Work</a>
    </form>

@endsection

