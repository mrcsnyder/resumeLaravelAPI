@if($education->education_degrees->count() > 0)
    <hr>
    <h2>Degrees</h2>
    <div class="row">
        @foreach($education->education_degrees as $degree)

            <div class="col-md-6 col-lg-6 mt-3 text-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$degree->major}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Completed: {{$degree->completed_month_year_format}}</h6>
                        <p class="card-text">{{$degree->gpa}} GPA, {{$degree->honors_info}}</p>
                        <a href="/education/degree/edit-degree-certificate/{{$degree->id}}" class="card-link">Edit Degree</a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <hr>
@endif
