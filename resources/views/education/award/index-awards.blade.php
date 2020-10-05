<h2><i class="fas fa-award"></i> Academic Awards <a class="btn btn-sm btn-dark" href="/education/award/create-award">Create Award</a></h2>

<div class="row">
    @foreach($awards as $award)


        <div class="col-md-6 col-lg-6 mt-3 text-center">
            <div class="card" style="">
                <div class="card-body">
                    <h5 class="card-title">{{$award->award_name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$award->date_range}}</h6>
                    <a class="btn btn-sm btn-dark" href="/education/award/edit-award/{{$award->id}}">Edit</a>
                </div>
            </div>
        </div>

    @endforeach
</div>
