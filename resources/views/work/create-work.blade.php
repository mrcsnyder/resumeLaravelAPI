@extends('layouts.default')

@section('content')

    <h1>Create Work</h1>
    <form method="POST" action="{{ route('/work/create-work') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$personal_id}}" name="personal_id"/>
        <div class="form-row">
            <div class="col">

                <div class="form-group">
        <label for="">Company Name</label>
        <input class="form-control" id="company_name" name="company_name" type="text"/>
                </div>
            </div>

            <div class="col">

                <div class="form-group">
        <label for="">Role</label>
        <input class="form-control" id="role" name="role" type="text"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="details">Job Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="form-row">
            <div class="col">

                <div class="form-group">
                    <label for="start_date_month_year_preformat">Start Month & Year</label>
                    <input class="form-control" id="start_date_month_year_preformat" name="start_date_month_year_preformat" type="month"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_date_month_year_preformat">End Month & Year (Leave Blank if Still Employed)</label>
                    <input class="form-control" id="end_date_month_year_preformat" name="end_date_month_year_preformat" type="month"/>
                </div>
            </div>

        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Create Work</button>

    </form>


@endsection

@section('scripts')
{{--    <script  src="/js/image_upload.js"></script>--}}
@endsection
