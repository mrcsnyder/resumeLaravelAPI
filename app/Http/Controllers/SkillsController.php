<?php

namespace App\Http\Controllers;

use App\Skill;

use App\Http\Requests\MakeSkillRequest;

use App\Repositories\Personal\PersonalRepositoryInterface;

use App\Repositories\Skill\SkillRepositoryInterface;
use App\Repositories\Skill\SkillRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SkillsController extends Controller
{

    protected $currentUser;
    protected $skill;

    public function __construct( Skill $skill)
    {
        // set the model
        $this->skill = new SkillRepository($skill);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;

            return $next($request);
        });

    }
//
//    //skills index partial for inclusion in work index view
//    public function index(PersonalRepositoryInterface $personalRepo,
//                          SkillRepositoryInterface $skillRepo)
//    {
//
//        //possibly a neater way to do this, but it is working good
//        //see PersonalRepository method
//        $personal = $personalRepo->find($this->currentUser);
//
//        $personal_id = $personal->id;
//
//        $skills = $skillRepo->find($personal_id);
//
//        $coding = $skills->where('category','=','coding');
//
//        $methods_devops = $skills->where('category','=','methods_devops');
//
//        $software = $skills->where('category','=','software');
//
//        $operating_systems = $skills->where('category','=','operating_systems');
//        $business = $skills->where('category','=','business');
//
//
//        return view('work.skill.skill-index', compact(
//            'coding',
//            'methods_devops',
//            'operating_systems',
//            'software',
//            'business'
//        ));
//
//    }

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
