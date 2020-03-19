@extends('layouts.default')

@section('title', 'Edit '.$award->award_type)

@section('content')

    <h1>Editing <span class="text-muted">'{{$award->award_name}}'</span></h1>

    <form class="mb-3" method="POST" action="{{ route('/education/award/award-update', [$award->id])}}">
        <input name="_method" type="hidden" value="PATCH">
        @csrf

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="award_type">Award Type</label>
                    <select class="form-control" id="award_type" name="award_type">
                        <option {{ ($award->award_type != 'honor_roll' || $award->award_type != 'scholarship') ? 'selected' : '' }}>Choose Award Type</option>
                        <option value="honor_roll" {{ $award->award_type == 'honor_roll' ? 'selected' : '' }}>Honor Roll</option>
                        <option value="scholarship" {{ $award->award_type == 'scholarship' ? 'selected' : '' }}>Scholarship</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="award_name">Award Name</label>
                    <input class="form-control" id="major" value="{{$award->award_name}}" name="award_name" type="text"/>
                </div>
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <div class="form-group">
                    <label for="awarded_by">Awarded By</label>
                    <input class="form-control" id="awarded_by" name="awarded_by" value="{{$award->awarded_by}}" type="text"/>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="date_range">Time Period</label>
                    <input class="form-control" id="date_range" value="{{$award->date_range}}" name="date_range" type="text"/>
                </div>
            </div>

        </div>

        <button class="btn btn-lg btn-dark text-center" type="submit">Update Award</button>

    </form>

    <a class="btn btn-md btn-success" href="/education"><i class="fas fa-graduation-cap"></i> Back to Education</a>
@endsection
