<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personal;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

//Intervention Image package dependency (see config/app.php)
use Image;

class PersonalController extends Controller
{
    //personal index view action
    public function index(){

        //possibly a neater way to do this:
        $personal = Personal::take(1)->get();

        return view('personal.personal-index', compact('personal'));
    }


    //personal create view action
    public function create(){

        return view('personal.create-personal');
    }


    // store personal post action
    public function store(Request $request){

        $personal = new Personal();

        $personal->name = $request->input('name');
        $personal->current_role = $request->input('current_role');
        $personal->git_source = $request->input('git_source');
        $personal->linkedin = $request->input('linkedin');

        //get the file from the profile_image request...
        $profile_image = $request->file('profile_image');

        //set the file name
        $filename = uniqid(). $profile_image->getClientOriginalName();

        //move the file to correct location
        $profile_image->move('images/', $filename);

        //here is where I need to add the thumbnail also....
        $thumb_string="thmb-".$filename;

        //image intervention creating different sized images
        Image::make( public_path('images/'.$filename))->resize(240, 240)->save('images/'.$thumb_string);

        //set personal profile_image to filename
        $personal->profile_image = $filename;

        //get the file from the resume request...
        $resume_file = $request->file('resume');

        $pdf_filename = $resume_file->getClientOriginalName();

        //move the file to correct location
        $resume_file->move('pdf-resume/', $pdf_filename);

        //set personal profile_image to filename
        $personal->resume = $pdf_filename;

        $personal->professional_intro = $request->input('professional_intro');
        $personal->hobbies_interests = $request->input('hobbies_interests');

        $personal->save();

        //redirect back with message for users!
        Session::flash('message', 'Personal Details Successfully Added!');
        return redirect('/personal');
    }


    // edit personal view action
    public function edit($id){

        $personal = Personal::findOrFail($id);

        return view('personal.edit-personal', compact('personal'));

}


//update patch action

public function update(Request $request, $id){

    $personal = Personal::findOrFail($id);

    $personal->name = $request->input('name');
    $personal->current_role = $request->input('current_role');
    $personal->git_source = $request->input('git_source');
    $personal->linkedin = $request->input('linkedin');
    $personal->professional_intro = $request->input('professional_intro');
    $personal->hobbies_interests = $request->input('hobbies_interests');

    $filename ="";
    if($request->hasFile('profile_image')){

        //get the file from the profile_image request...
        $profile_image = $request->file('profile_image');

        //set the file name
        $filename = uniqid(). $profile_image->getClientOriginalName();

        //move the file to correct location
        $profile_image->move('images/', $filename);

        //here is where I need to add the thumbnail also....
        $thumb_string="thmb-".$filename;

        //image intervention creating different sized images
        Image::make( public_path('images/'.$filename))->resize(240, 240)->save('images/'.$thumb_string);
        $personal->profile_image = $filename;

    }

    $pdf_filename ="";
//check if resume has been patched, and if so update it
    if($request->hasFile('resume')){

        //get the file from the resume request...
        $resume_file = $request->file('resume');

        $pdf_filename = $resume_file->getClientOriginalName();

        //move the file to correct location
        $resume_file->move('pdf-resume/', $pdf_filename);
        $personal->resume = $pdf_filename;
    }


    $personal->save();

    //redirect back
    return Redirect::back()->with(Session::flash('message', 'Personal Details Successfully Updated!'));

}


}
