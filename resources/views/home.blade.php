@extends('layouts.default')

@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-graduate"></i> Education</h5>
                    <p class="card-text">Use this portal to manage your Educational background API endpoint.</p>
                    <a href="/education" class="btn btn-primary">Manage Education</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-briefcase"></i> Projects</h5>
                    <p class="card-text">Use this portal to manage your Portfolio of developer projects API endpoint.</p>
                    <a href="/projects" class="btn btn-warning">Manage Projects</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-bacon"></i> Work History</h5>
                    <p class="card-text">Use this portal to manage your Work History API endpoint.</p>
                    <a href="#" class="btn btn-success">Manage Work History</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-guitar"></i> Personal Details</h5>
                    <p class="card-text">Use this portal to manage your Personal Details API endpoint.</p>
                    <a href="#" class="btn btn-danger">Manage Personal Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
