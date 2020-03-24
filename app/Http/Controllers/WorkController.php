<?php

namespace App\Http\Controllers;

use App\Work;
use App\Skill;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class WorkController extends Controller
{
    //
    public function index(){

        $work = Work::all();

        $skills = Skill::all();

        $coding = $skills->where('category','=','coding');

        $methods_devops = $skills->where('category','=','methods_devops');

        $software = $skills->where('category','=','software');

        $operating_systems = $skills->where('category','=','operating_systems');
        $business = $skills->where('category','=','business');


        return view('work.work-index', compact(
            'work',
            'coding',
            'methods_devops',
            'operating_systems',
            'software',
            'business'
        ));
    }


    public function create(){

        return view('work.create-work');
    }


    public function store(Request $request){

        $work = new Work();

        $work->role = $request->input('role');
        $work->company_name = $request->input('company_name');
        $work->description = $request->input('description');
        $work->start_date_month_year_preformat = $request->input('start_date_month_year_preformat');

        //work around to tack on day at end of request
        $pre_date_str = $request->input('start_date_month_year_preformat').'-01';

        $pre_date_month_year = date('M Y', strtotime($pre_date_str));

        $work->start_date_month_year_format = $pre_date_month_year;


        //check if end_date_month_year_preformat request input is null when posting and if so then set that to Present...
        // ...if not proceed with date formatting
        if($request->input('end_date_month_year_preformat') == null){
            $work->end_date_month_year_preformat = 'Present';
            $work->end_date_month_year_format = 'Present';

        }
        else {

            $work->end_date_month_year_preformat = $request->input('end_date_month_year_preformat');

            //work around to tack on day at end of request
            $pre_date_str = $request->input('end_date_month_year_preformat').'-01';

            $pre_date_month_year = date('M Y', strtotime($pre_date_str));

            //format pre_date_month_year to store only month and year in format I prefer
            $work->end_date_month_year_format = $pre_date_month_year;

        }

        //save work history
        $work->save();


        //redirect back with message for users!
        Session::flash('message', 'Work Successfully Added!');
        return redirect('/work');


    }


    //edit view action
    public function edit($id){

        $work = Work::findOrFail($id);

        return view('work.edit-work', compact('work'));
    }

    //update work post/patch action
    public function update(Request $request, $id){
        $work = Work::findOrFail($id);


        //update all of the work attributes
        $work->update($request->all());


        $work->start_date_month_year_preformat = $request->input('start_date_month_year_preformat');

        //work around to tack on day at end of request
        $pre_date_str = $request->input('start_date_month_year_preformat').'-01';

        $pre_date_month_year = date('M Y', strtotime($pre_date_str));

        $work->start_date_month_year_format = $pre_date_month_year;


        //check if end_date_month_year_preformat request input is null when posting and if so then set that to Present...
        // ...if not proceed with date formatting
        if($request->input('end_date_month_year_preformat') == null){
            $work->end_date_month_year_preformat = 'Present';
            $work->end_date_month_year_format = 'Present';

        }
        else {

            $work->end_date_month_year_preformat = $request->input('end_date_month_year_preformat');

            //work around to tack on day at end of request
            $pre_date_str = $request->input('end_date_month_year_preformat').'-01';

            $pre_date_month_year = date('M Y', strtotime($pre_date_str));

            //format pre_date_month_year to store only month and year in format I prefer
            $work->end_date_month_year_format = $pre_date_month_year;

        }

        //save updated work history
        $work->save();

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Work Successfully Updated!'));

    }


    //create skill view action
    public function createSkill(){

        return view('work.skill.create-skill');
    }


    //store skill post action

    public function storeSkill(Request $request){

        $skill = new Skill();
        $skill->skill = $request->input('skill');
        $skill->category = $request->input('category');
        $skill->rating = $request->input('rating');
        $skill->save();


        //redirect back with message for users!
        Session::flash('message', 'Skill Successfully Added!');
        return redirect('/work');

    }


    //update skill view action

    public function editSkill($id){
        $skill = Skill::findOrFail($id);

    return view('work.skill.edit-skill', compact('skill'));

    }

    public function updateSkill(Request $request, $id) {


        $skill = Skill::findOrFail($id);


        //update all of the work attributes
        $skill->update($request->all());

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Skill Successfully Updated!'));

    }





}
