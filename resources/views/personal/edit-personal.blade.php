@extends('layouts.default')


@section('content')

    <h1>Update Personal Details</h1>
    <img src="/images/personal/{{$personal->profile_image}}" id="portrait-img" alt="{{$personal->name}}" class="img-fluid portrait-about d-block rounded-circle">
    <form class="mb-3" method="POST" action="{{ route('/personal/personal-update', [$personal->id])}}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf

        <input type="hidden" name="user_id" value="{{$user_id}}"/>

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

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="git_source"><i class="fab fa-git-square fa-2x"></i> Git Host URL</label>
                    <input class="form-control" id="git_source" name="git_source" value="{{$personal->git_source}}" type="text"/>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="linkedin"><i class="fab fa-linkedin fa-2x"></i> LinkedIn Profile URL</label>
                    <input class="form-control" id="linkedin" name="linkedin" value="{{$personal->linkedin}}" type="text"/>
                </div>
            </div>
        </div>

        <div class="form-group">

            <label for="profile_image">Profile Image</label>
            <input type="file" name="image_file" id="image_file" onchange="readURL(this);"/>
            <input type="text" type="hidden" class="img_name" name="profile_image">
        </div>

        <div id="image_preview">
            <img id="img_logo" class="img-fluid img-thumbnail" src="#" alt="uploaded image">
        </div>

        <div class="form-group">
            <label for="resume">Resume (PDF)</label>
            <input type="file" name="pdf_file" id="pdf_file"/>
            <input type="text" type="hidden" class="file_name" name="resume">
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

        <a class="btn btn-lg btn-success" href="/personal"><i class="fas fa-user"></i> Back to Personal</a>

    </form>


@endsection

@section('scripts')
    <script  src="/js/image_upload.js"></script>
@endsection
