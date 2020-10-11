@if($project->images->count() > 0)
    <h4 class="mt-3">Current Images</h4>
@endif
<div class="row mb-3">

    @foreach($project->images as $image)

        <div class="col-md-6 col-lg-3 mt-3 text-center">

            <form method="POST" action="{{ route('/projects/project-image-delete', [$image->id])}}">
                <input name="_method" type="hidden" value="DELETE">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
            </form>

            @if($image->main_img == 1)
                <span class="text-muted"><i class="fas fa-star"></i> Main Image <i class="fas fa-star"></i><br/></span>
            @endif

            <a href="/images/{{$image->file_name}}" target="_blank">
                <img class="img-fluid mx-auto" src="/images/thmb-{{$image->file_name}}">
            </a>

            <div class="card card-body">

                @if($image->description == null)
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="{{'#'.$image->id}}">Add Caption</button>
                    <div id="{{$image->id}}" class="collapse">

                        <form class="mt-2" method="POST" action="{{ route('/projects/image-update', [$image->id])}}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}" />

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="main_img" value="{{$image->main_img}}" {{ $image->main_img == 1 ? 'checked' : '' }}> Set to Main Image
                                </label>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Save</button>

                        </form>
                    </div>
                @else

                    <h6>Current Caption:</h6><p>{{$image->description}}</p>
                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="{{'#'.$image->id}}">Edit Caption</button>
                    <div id="{{$image->id}}" class="collapse">

                        <form class="mt-2" method="POST" action="{{ route('/projects/image-update', [$image->id])}}">
                            @csrf

                            <input type="hidden" name="project_id" value="{{$project->id}}" />

                            <div class="form-check">
                                <input type="checkbox" name="main_img" value="{{$image->main_img}}" {{ $image->main_img == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="main_img"> Set to Main Image</label>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="description">{{$image->description}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </form>
                    </div>

                @endif

            </div>

        </div>

    @endforeach
</div>
