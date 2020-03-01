<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

class ProjectsController extends Controller
{
    //

    public function index(){

        $projects = Project::all();

        return view('projects-index', compact('projects'));
    }

    public function create() {

        return view('create-project');

    }

    public function edit($id){

        $project = Project::findOrFail($id);

        return view('edit-project', compact('project'));
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

}
