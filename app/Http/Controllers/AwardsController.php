<?php

namespace App\Http\Controllers;

use App\Award;
use App\Http\Requests\MakeAwardRequest;
use App\Repositories\Award\AwardRepository;
use App\Repositories\Award\AwardRepositoryInterface;
use App\Repositories\Personal\PersonalRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AwardsController extends Controller
{
    //
    protected $award;
    protected $currentUser;

    public function __construct(Award $award)
    {
        // set the model
        $this->award = new AwardRepository($award);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;
            return $next($request);
        });

    }


    //create award view action
    public function createAward(PersonalRepositoryInterface $personalRepo){

        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        return view('education.award.create-award', compact('personal_id'));
    }

    //store created award action
    public function storeAward(MakeAwardRequest $request){

        $this->award->create($request->all());

        return redirect('/education')->with(Session::flash('message', 'Honor or Scholarship Successfully Added!'));

    }

    public function editAward($id, PersonalRepositoryInterface $personalRepo, AwardRepositoryInterface $awardRepo){

        $award = $awardRepo->get($id);

        //see PersonalRepository method
        //TODO clean up the edit award form template(s) to include personal_id automatically, but provide it for create
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        return view('education.award.edit-award', compact('award', 'personal_id'));

    }

    //update & store Award action
    public function updateAward(MakeAwardRequest $request, $id){

        $this->award->update($request->all(), $id);

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Award Successfully Updated!'));

    }




}
