<?php

namespace App\Http\Controllers;

use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;

use App\Repositories\ProjectImage\ProjectImageRepository;
use App\Repositories\ProjectImage\ProjectImageRepositoryInterface;

use App\Repositories\Personal\PersonalRepositoryInterface;

use Illuminate\Http\Request;

use App\Http\Requests\MakeProjectRequest;

use App\Http\Utilities\ControllerHelpers;
use App\Http\Utilities\ImageHelpers;

use App\Project;

use App\ProjectImage;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

class ProjectsController extends Controller
{

    protected $project;
    protected $currentUser;
    protected $image;
    protected $projectImagePath;

    public function __construct(Project $project, ProjectImage $img)
    {
        $this->image = new ProjectImageRepository($img);
        $this->project = new ProjectRepository($project);
        $this->projectImagePath = 'images/portfolio-gallery-images/';

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;
            return $next($request);
        });
    }

    public function index(PersonalRepositoryInterface $personalRepo){

        $personal = $personalRepo->find($this->currentUser);

        $projects =  $personal->projects;

        return view('projects.projects-index', compact('projects'));
    }

    public function create(PersonalRepositoryInterface $personalRepo) {

        $user = $personalRepo->find($this->currentUser);

        $personal_id = $user->id;

        return view('projects.create-project', compact('personal_id'));
    }

    public function edit($id, PersonalRepositoryInterface $personalRepo,
                         ProjectRepositoryInterface $projectRepo){

        $user = $personalRepo->find($this->currentUser);
        $personal_id = $user->id;

        $project = $projectRepo->get($id);

        return view('projects.edit-project', compact('project', 'personal_id'));
    }

    public function store(MakeProjectRequest $request) {

        $this->project->create($request->all());

        //redirect back with message for users!
        Session::flash('message', 'Project Successfully Added!');
        return redirect('/projects');
    }

    public function update(MakeProjectRequest $request, $id)
    {
        $this->project->update($request->all(), $id);

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Project Successfully Updated!'));
    }

    //project gallery function
    public function multiImageUpload(Request $request, ProjectRepositoryInterface $projectRepo)
    {
        $project = $projectRepo->get($request->input('project_id'));

        $file_name = ControllerHelpers::storeFile($request->file('file'), $this->projectImagePath);

        ImageHelpers::generateThumb(430,296, $file_name, $this->projectImagePath);

        //save the image details into the database
        $image = $project->images()->create([

            'project_id' => $request->input('project_id'),
            'file_name' => $file_name,
        ]);

        return $image;
    }

    //image caption, set or unset main_img action
    public function updateImageCaption($id,
                                       Request $request,
                                       ProjectRepositoryInterface $projectRepo )
    {
        $project = $projectRepo->get($request->input('project_id'));

        //if main_img checkbox is set to true this condition is met
        if((($request->has('main_img')) )){

            //update all other related images by setting them to false before setting new main_img
            $project->images()->update([ 'main_img'=> false ]);

            $request->request->add(['main_img'=> true ]);
        }
        //if it is not met, then this ensures that the request value is present and set to false
        else {
            $request->request->add(['main_img'=> false ]);
        }

        $this->image->update($request->all(), $id);

        return redirect()->back()->with(Session::flash('message', 'Portfolio image successfully updated!'));
    }

//destroy individual gallery image (from portfolio gallery images) action
    public function destroyImage($id)
    {
        $this->image->delete($id);

        return redirect()->back()->with(Session::flash('message', 'Portfolio Gallery Image was deleted!'));
    }

//destroy entire Project and any related images (portfolio gallery images) action
    public function destroyProject($id, ProjectRepositoryInterface $projectRepo)
    {
        $project = $projectRepo->get($id);

        //delete any gallery portfolio images associated with project
        $project->images()->delete();

        //delete project
        $project->delete();

        return redirect()->back()->with(Session::flash('message', 'Project and all images are now deleted!'));
    }

}
