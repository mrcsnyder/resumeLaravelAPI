
@if($education->education_certificates->count() > 0)
    <h2>Certificates</h2>
    <div class="row">
        @foreach($education->education_certificates as $cert)

            <div class="col-md-6 col-lg-6 mt-3 text-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$cert->major}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Completed: {{$cert->completed_month_year_format}}</h6>
                        <p class="card-text">{{$cert->honors_info}}</p>
                        <a href="/education/degree/edit-degree-certificate/{{$cert->id}}" class="card-link">Edit Certificate</a>

                    </div>
                </div>
            </div>

        @endforeach
    </div>
<hr>
@endif
