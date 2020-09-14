@extends('layouts.default')
@section('title', 'Create Personal Details')
@section('content')

    <h1>Add Personal Details</h1>

    <form method="POST" action="{{ route('/personal/create-personal') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$user_id}}" name="user_id"/>
        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text"/>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="current_role">Current Role</label>
                    <input class="form-control" id="current_role" name="current_role" type="text"/>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="git_source"><i class="fab fa-git-square fa-2x"></i> Git Host URL</label>
                    <input class="form-control" id="git_source" name="git_source" type="text"/>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
                    <label for="linkedin"><i class="fab fa-linkedin fa-2x"></i> LinkedIn Profile URL</label>
                    <input class="form-control" id="linkedin" name="linkedin" type="text"/>
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
            <textarea class="form-control" id="professional_intro" name="professional_intro"></textarea>
        </div>

        <div class="form-group">
            <label for="hobbies_interests">Hobbies &amp; Interests</label>
            <textarea class="form-control" id="hobbies_interests" name="hobbies_interests"></textarea>
        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Create Personal Details</button>

    </form>


@endsection

@section('scripts')
        <script  src="/js/image_upload.js"></script>
@endsection
