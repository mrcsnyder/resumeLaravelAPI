@extends('layouts.default')

@section('content')

    <h1>Create Award</h1>
    <form method="POST" action="{{ route('/education/create-award') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="award_type">Award Type</label>
                    <select class="form-control" id="award_type" name="award_type">
                        <option selected>Choose Award Type</option>
                        <option value="honor_roll">Honor Roll</option>
                        <option value="scholarship">Scholarship</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="">Award Name</label>
                    <input class="form-control" id="award_name" name="award_name" type="text"/>
                </div>
            </div>


        </div>

        <div class="form-row">
            <div class="col">


                <div class="col">
                    <div class="form-group">
                        <label for="awarded_by">Awarded By</label>
                        <input class="form-control" id="awarded_by" name="awarded_by" type="text"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_range">Time Period</label>
                    <input class="form-control" id="date_range" name="date_range" type="text"/>
                </div>
            </div>



        </div>


        <button class="btn btn-lg btn-primary text-center" type="submit">Create Award</button>

    </form>




@endsection

@section('scripts')
{{--    <script  src="/js/image_upload.js"></script>--}}
@endsection
