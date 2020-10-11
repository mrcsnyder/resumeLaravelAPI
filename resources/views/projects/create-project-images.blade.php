<h4 class="mt-3">Add Project Gallery Images</h4>
<div class="row mt-3">
    <div class="col-md-12">
        <form action="{{url('/projects/multi-upload')}}"
              class="dropzone" id="addImages">
            @csrf
            <input type="hidden" name="project_id" value="{{$project->id}}">

        </form>
    </div>

</div>
