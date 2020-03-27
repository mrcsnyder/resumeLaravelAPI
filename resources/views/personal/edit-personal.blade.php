@extends('layouts.default')

@section('content')

    <h1>Update Personal Details</h1>
    <form class="mb-3" method="POST" action="{{ route('/personal/personal-update', [$personal->id])}}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" value="{{$personal->name}}" type="text"/>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="current_role">Current Role</label>
                    <input class="form-control" id="current_role" name="current_role" value="{{$personal->current_role}}" type="text"/>
                </div>
            </div>
        </div>

        <div class="form-group">

            <label for="profile_image">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" onchange="readURL(this);"/>
        </div>

        <div id="image_preview">
            <img id="img_logo" class="img-fluid img-thumbnail" src="#" alt="uploaded image">
        </div>

        <div class="form-group">
            <label for="resume">Resume (PDF)</label>
            <input type="file" name="resume" id="resume"/>
        </div>

        <div class="form-group">
            <label for="professional_intro">Professional Intro</label>
            <textarea class="form-control" id="professional_intro" name="professional_intro">{{$personal->professional_intro}}</textarea>
        </div>

        <div class="form-group">
            <label for="hobbies_interests">Hobbies &amp; Interests</label>
            <textarea class="form-control" id="hobbies_interests" name="hobbies_interests">{{$personal->hobbies_interests}}</textarea>
        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Update Personal Details</button>

        <a class="btn btn-md btn-success" href="/personal"><i class="fas fa-user"></i> Back to Personal</a>

    </form>


@endsection

@section('scripts')
    <script  src="/js/image_upload.js"></script>
@endsection
