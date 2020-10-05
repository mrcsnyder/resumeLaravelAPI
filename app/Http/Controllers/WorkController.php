<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeWorkRequest;

use App\Work;

use App\Repositories\Work\WorkRepositoryInterface;
use App\Repositories\Work\WorkRepository;

use App\Repositories\Skill\SkillRepositoryInterface;

use App\Repositories\Personal\PersonalRepositoryInterface;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
{

    protected $currentUser;
    protected $work;

    public function __construct(Work $work)
    {
        // set the model
//        $this->skill = new SkillRepository($skill);
        $this->work = new WorkRepository($work);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;

            return $next($request);
        });

    }

    public function index(PersonalRepositoryInterface $personalRepo,
                          WorkRepositoryInterface $workRepo,
                          SkillRepositoryInterface $skillRepo
    ){

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        $skills = $skillRepo->find($personal_id);
        $work = $workRepo->find($personal_id);

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

    public function store(MakeWorkRequest $request){

        $start_month_year_format = ($this->returnMonthYear($request->input('start_date_month_year_preformat')));
        $end_month_year_format = ($this->returnMonthYear($request->input('end_date_month_year_preformat')));

        //nifty way to append key/values to request array
        $request->request->add(['start_date_month_year_format' => $start_month_year_format, 'end_date_month_year_format' => $end_month_year_format]);

        $this->work->create($request->all());

        //redirect back with message for users!
        Session::flash('message', 'Work Successfully Added!');
        return redirect('/work');

    }

    //edit view action
    public function edit($id,
                         PersonalRepositoryInterface $personalRepo,
                         workRepositoryInterface $workRepo)
    {

        $personal = $personalRepo->find($this->currentUser);
        $personal_id = $personal->id;
        //TODO modify forms so that this is not necessary in the edit form for education
        // (degree not necessary since it is related to education record)

        //get work collection
        $work = $workRepo->get($id);

        return view('work.edit-work', compact('work', 'personal_id'));
    }

    //update work post/patch action
    public function update(MakeWorkRequest $request, $id){

        $start_month_year_format = ($this->returnMonthYear($request->input('start_date_month_year_preformat')));
        $end_month_year_format = ($this->returnMonthYear($request->input('end_date_month_year_preformat')));

        //nifty way to append key/values to request array
        $request->request->add(['start_date_month_year_format' => $start_month_year_format, 'end_date_month_year_format' => $end_month_year_format]);

        $this->work->update($request->all(), $id);

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Work Successfully Updated!'));

    }

    //format a passed year & month (e.g. 2020-09 becomes Sep 2020)
    private function returnMonthYear($date){

        if($date == null) {
            $monthYear = 'Present';
        }
        else {
            //work around to tack on day at end of passed request date
            $pre_date_str = $date.'-01';

            //format given date to store only month and year in neat format
            // i.e. 'Aug 2017' or 'Dec 2012' etc.
            $monthYear = date('M Y', strtotime($pre_date_str));

        }

        return $monthYear;

    }

}
