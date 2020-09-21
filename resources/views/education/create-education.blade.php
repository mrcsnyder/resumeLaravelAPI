@extends('layouts.default')
@section('title', 'Add Education')
@section('content')

    <h1>Add Education</h1>
    <form method="POST" action="{{ route('/education/create-education') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="personal_id" value="{{$personal_id}}"/>

        <label for="">School Name</label>
        <input class="form-control" id="school_name" name="school_name" type="text"/>

        <div class="form-group">

            <label for="profile_image">School Logo</label>
            <input type="file" name="image_file" id="image_file" onchange="readURL(this);"/>
            <input type="text" type="hidden" class="img_name" name="logo">
        </div>

        <div id="image_preview">
            <img id="img_logo" class="img-fluid img-thumbnail" src="#" alt="uploaded image">
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details"></textarea>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="start_month_year_preformat">Start Month & Year</label>
                    <input class="form-control" id="start_month_year_preformat" name="start_month_year_preformat" type="month"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_month_year_preformat">End Month & Year</label>
                    <input class="form-control" id="end_month_year_preformat" name="end_month_year_preformat" type="month"/>
                </div>
            </div>

        </div>


        <button class="btn btn-lg btn-dark text-center" type="submit">Save Education</button>
        <a class="btn btn-lg btn-success" href="/education"><i class="fas fa-user-graduate"></i> Back to Education</a>

    </form>




@endsection

@section('scripts')
    <script  src="/js/image_upload.js"></script>
 @endsection
