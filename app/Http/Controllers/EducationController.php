<?php

namespace App\Http\Controllers;

use App\Education;

use App\Degree;

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

        //save preformatted start date (i.e. '2017-08' to start_month_year_preformat
        $edu->start_month_year_preformat = $request->input('start_month_year_preformat');

        //work around to tack on day at end of request
        $pre_start_date_str = $request->input('start_month_year_preformat').'-01';

        //format $pre_start_date_month_year to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $pre_start_date_month_year = date('M Y', strtotime($pre_start_date_str));

       // set start_month_year_format to neatly formatted start date
        $edu->start_month_year_format = $pre_start_date_month_year;

        //save preformatted end date (i.e. '2017-08' to start_month_year_preformat
        $edu->end_month_year_preformat = $request->input('end_month_year_preformat');

        //work around to tack on day at end of request
        $pre_end_date_str = $request->input('end_month_year_preformat').'-01';

        //format $pre_end_date_month_year to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $pre_end_date_month_year = date('M Y', strtotime($pre_end_date_str));

        // set end_month_year_format to neatly formatted start date
        $edu->end_month_year_format = $pre_end_date_month_year;


        $edu->save();

        //redirect back with message for users!
        Session::flash('message', 'Education Successfully Added!');
        return redirect('/education');

    }

    //edit education view action
    public function edit($id){

        //get education collection
        $education = Education::findOrFail($id);
        //get degrees from education collection
        $degrees = $education->degrees->where('degree_or_certificate','=','degree');
        $certificates = $education->degrees->where('degree_or_certificate','=','certificate');

        return view('education.edit-education', compact('education', 'degrees', 'certificates'));
    }


    //edit education update action
    public function update(Request $request, $id)
    {

        //add some error handling
        $edu = Education::findOrFail($id);

        //update all of the project attributes
        $edu->update($request->all());

        //save preformatted start date (i.e. '2017-08' to start_month_year_preformat
        $edu->start_month_year_preformat = $request->input('start_month_year_preformat');

        //work around to tack on day at end of request
        $pre_start_date_str = $request->input('start_month_year_preformat').'-01';

        //format $pre_start_date_month_year to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $pre_start_date_month_year = date('M Y', strtotime($pre_start_date_str));

        // set start_month_year_format to neatly formatted start date
        $edu->start_month_year_format = $pre_start_date_month_year;

        //save preformatted end date (i.e. '2017-08' to start_month_year_preformat
        $edu->end_month_year_preformat = $request->input('end_month_year_preformat');

        //work around to tack on day at end of request
        $pre_end_date_str = $request->input('end_month_year_preformat').'-01';

        //format $pre_end_date_month_year to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $pre_end_date_month_year = date('M Y', strtotime($pre_end_date_str));

        // set end_month_year_format to neatly formatted start date
        $edu->end_month_year_format = $pre_end_date_month_year;

        $edu->save();


        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Education Successfully Updated!'));
    }


    //store certificate or diploma action that is utilized in the edit view for education
    public function storeCertificateDiploma(Request $request){

        $certDegree = new Degree();
        $certDegree->education_id = $request->input('school_id');
        $certDegree->degree_or_certificate = $request->input('degree_or_certificate');
        $certDegree->major = $request->input('major');
        $certDegree->honors_info = $request->input('honors_info');
        $certDegree->gpa = $request->input('gpa');

        $certDegree->completed_month_year_preformat = $request->input('completed_month_year');


        //work around to tack on day at end of request
        $pre_date_str = $request->input('completed_month_year').'-01';

        $pre_date_month_year = date('M Y', strtotime($pre_date_str));

        //format pre_date_month_year to store only month and year in format I prefer
        $certDegree->completed_month_year_format = $pre_date_month_year;
        $certDegree->save();

        //redirect back with message for users!
        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Certificate or Degree Successfully Added!'));
    }


    //edit degree or certificate action view
    public function editDegreeCertificate($id){

        $degree = Degree::findOrFail($id);
        $edu = $degree->education;

        return view('education.degree.edit-degree-certificate', compact('degree', 'edu'));
    }

    //update degree or certificate action view
    public function updateDegreeCertificate(Request $request, $id){


        //add some error handling
        $degree_cert = Degree::findOrFail($id);

        //update all of the project attributes
        $degree_cert->update($request->all());


        //save the formatted date into the format field of the db

        //work around to tack on day at end of request
        $pre_date_str = $request->input('completed_month_year').'-01';

        $pre_date_month_year = date('M Y', strtotime($pre_date_str));

        //format pre_date_month_year to store only month and year in format I prefer
        $degree_cert->completed_month_year_format = $pre_date_month_year;

        //save the formatted date
        $degree_cert->save();

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Degree or Certificate Successfully Updated!'));

    }



}
