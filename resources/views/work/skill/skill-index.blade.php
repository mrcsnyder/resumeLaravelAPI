
<h2><i class="fas fa-code"></i> Skills <a class="btn btn-sm btn-dark" href="/work/skill/create-skill">Add Skill</a></h2>

<div class="row mb-3">

    <div class="col-md-6 col-lg-6 mt-3 text-center">
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">Business</h5>
                @foreach($business as $biz)
                    <h6 class="card-subtitle mb-2 text-muted">{{$biz->skill}} <a class="btn btn-sm btn-dark" href="/work/skill/edit-skill/{{$biz->id}}">Edit</a></h6>
                @endforeach
            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-6 mt-3 text-center">
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">Coding</h5>
                @foreach($coding as $code)
                    <h6 class="card-subtitle mb-2 text-muted">{{$code->skill}} <a class="btn btn-sm btn-dark" href="/work/skill/edit-skill/{{$code->id}}">Edit</a></h6>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 mt-3 text-center">
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">Methodologies &amp; DevOps</h5>
                @foreach($methods_devops as $methods)
                    <h6 class="card-subtitle mb-2 text-muted">{{$methods->skill}} <a class="btn btn-sm btn-dark" href="/work/skill/edit-skill/{{$methods->id}}">Edit</a></h6>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 mt-3 text-center">
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">OS</h5>
                @foreach($operating_systems as $os)
                    <h6 class="card-subtitle mb-2 text-muted">{{$os->skill}} <a class="btn btn-sm btn-dark" href="/work/skill/edit-skill/{{$os->id}}">Edit</a></h6>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 mt-3 text-center">
        <div class="card" style="">
            <div class="card-body">
                <h5 class="card-title">Software</h5>
                @foreach($software as $soft)
                    <h6 class="card-subtitle mb-2 text-muted">{{$soft->skill}} <a class="btn btn-sm btn-dark" href="/work/skill/edit-skill/{{$soft->id}}">Edit</a></h6>
                @endforeach
            </div>
        </div>
    </div>

</div>
