<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeSkillRequest;
use App\Personal;

use App\Work;

use App\Skill;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Repositories\Skill\SkillRepository;

use App\Repositories\Personal\PersonalRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class WorkController extends Controller
{
    //

    protected $currentUser;
    protected $skill;


    public function __construct(Skill $skill)
    {
        // set the model
        $this->skill = new SkillRepository($skill);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;

            return $next($request);
        });

    }

    public function index(PersonalRepositoryInterface $personalRepo,
                          SkillRepositoryInterface $skillRepo){


        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        $skills = $skillRepo->find($personal_id);

        $work = Work::where('personal_id','=',$personal_id)->get();


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


    public function create(PersonalRepositoryInterface $personalRepo){

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        return view('work.create-work', compact('personal_id'));
    }


    public function store(Request $request){

        $work = new Work();

        $work->personal_id = $request->input('personal_id');
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

        //get currently signed in user
        $user = auth()->user();

        //store users id
        $user_id = $user->id;

        $personal = Personal::where('user_id','=',$user_id)->first();
        $personal_id = $personal->id;

        $work = Work::findOrFail($id);

        return view('work.edit-work', compact('work', 'personal_id'));
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
    public function createSkill(PersonalRepositoryInterface $personalRepo){

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        return view('work.skill.create-skill', compact('personal_id'));
    }

    //store skill post action
    public function storeSkill(MakeSkillRequest $request){

        $this->skill->create($request->all());

        //redirect back with message for users!
        Session::flash('message', 'Skill Successfully Added!');
        return redirect('/work');

    }

    //update skill view action
    public function editSkill($id, PersonalRepositoryInterface $personalRepo, SkillRepositoryInterface $skillRepo){

        $skill = $skillRepo->get($id);

        //see PersonalRepository method
        //TODO clean up the edit award form template(s) to include personal_id automatically, but provide it for create
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;
    return view('work.skill.edit-skill', compact('skill', 'personal_id'));

    }

    public function updateSkill(MakeSkillRequest $request, $id) {

        $this->skill->update($request->all(), $id);

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Skill Successfully Updated!'));

    }


}
