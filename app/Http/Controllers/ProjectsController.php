<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use App\ProjectImage;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

//Intervention Image package dependency (see config/app.php)
use Image;

class ProjectsController extends Controller
{
    //

    public function index(){

        $projects = Project::all();

        return view('projects.projects-index', compact('projects'));
    }

    public function create() {

        return view('projects.create-project');

    }

    public function edit($id){

        $project = Project::findOrFail($id);

        return view('projects.edit-project', compact('project'));
    }

    public function store(Request $request) {

        $project = new Project();
        $project->title = $request->input('title');
        $project->intro = $request->input('intro');
        $project->full_detail = $request->input('full_detail');
        $project->project_url = $request->input('project_url');
        $project->project_repo = $request->input('project_repo');
        $project->save();

        //redirect back with message for users!
        Session::flash('message', 'Project Successfully Added!');
        return redirect('/projects');

    }


    public function update(Request $request, $id)
    {

     //add some error handling
    $project = Project::findOrFail($id);

    //update all of the project attributes
    $project->update($request->all());

    //TO DO:  add a check for if there are image files, and if there are then iterate through each file added,
    // and add them to the images table


        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Project Successfully Updated!'));
    }


    //project gallery function
    public function multiImageUpload(Request $request)
    {

        //get the file from the edit post page request...
        $file= $request->file('file');

        //set the file name
        $filename = uniqid(). $file->getClientOriginalName();

        //move the file to correct location
        $file->move('images/', $filename);

        //here is where I need to add the thumbnail also....
        $thumb_string="thmb-".$filename;

        //image intervention creating different sized images
        Image::make( public_path('images/'.$filename))->resize(430, 296)->save('images/'.$thumb_string);

        // save the image details into the database

        $project = Project::find($request->input('project_id'));
        $image = $project->images()->create([

            'project_id' => $request->input('project_id'),
            'file_name' => $filename,
        ]);


        return $image;
    }


    //image caption action
    public function updateImageCaption($id, Request $request)
    {

        //find specific image from ProjectImage using ORM
        $image = ProjectImage::findOrFail($id);

        //set image description to that passed through request
        $image->description = $request->input('description');

        //testing project relation
        $project = Project::findOrFail($request->input('project_id'));


        //if main_img checkbox is set to true this condition is met
        if(( ($request->has('main_img')) )){

            //update all other related images by setting them to false before setting new main_img
            $project->images()->update(['main_img'=>false]);

            // then set the current image
            $image->main_img = $request->has('main_img');

        }

        //finalize by saving caption to image
        $image->save();

        return redirect()->back()->with(Session::flash('message', 'Image caption updated!'));

    }

}
