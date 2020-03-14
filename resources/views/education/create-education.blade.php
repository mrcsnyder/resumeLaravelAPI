@extends('layouts.default')

@section('content')

    <h1>Create Education</h1>
    <form method="POST" action="{{ route('/education/create-education') }}">
        @csrf

        <label for="">School Name</label>
        <input class="form-control" id="school_name" name="school_name" type="text"/>


        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details"></textarea>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="project_url">Start Month & Year</label>
                    <input class="form-control" id="start_month_year" name="start_month_year" type="text"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="project_repo">End Month & Year</label>
                    <input class="form-control" id="end_month_year" name="end_month_year" type="text"/>
                </div>
            </div>

        </div>


        <button class="btn btn-lg btn-primary text-center" type="submit">Create Education</button>

    </form>




@endsection
