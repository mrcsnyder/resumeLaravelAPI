<?php

namespace App\Http\Controllers;

use App\Education;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EducationController extends Controller
{
    //education index action
    public function index(){

        $education = Education::all();

        return view('education.education-index', compact('education'));
    }

    //education create action
    public function create() {

        return view('education.create-education');

    }

    //education store action
    public function store(Request $request) {

        $edu = new Education();
        $edu->school_name = $request->input('school_name');
        $edu->details = $request->input('details');
        $edu->start_month_year = $request->input('start_month_year');
        $edu->end_month_year = $request->input('end_month_year');
        $edu->save();

        //redirect back with message for users!
        Session::flash('message', 'Education Successfully Added!');
        return redirect('/education');

    }

    //edit education view action
    public function edit($id){

        $education = Education::findOrFail($id);

        return view('education.edit-education', compact('education'));
    }


    //edit education update method
    public function update(Request $request, $id)
    {

        //add some error handling
        $edu = Education::findOrFail($id);

        //update all of the project attributes
        $edu->update($request->all());

        //TO DO:  add a check for if there are image files, and if there are then iterate through each file added,
        // and add them to the images table


        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Education Successfully Updated!'));
    }



}
