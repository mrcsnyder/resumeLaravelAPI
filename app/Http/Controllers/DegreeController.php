<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Http\Utilities\ControllerHelpers;
use App\Repositories\Degree\DegreeRepository;
use App\Repositories\Degree\DegreeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

//this handles both degrees and certificates
class DegreeController extends Controller
{
    protected $currentUser;
    protected $degree;

    public function __construct(Degree $degree)
    {
        // set the model
        $this->degree = new DegreeRepository($degree);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;
            return $next($request);
        });
    }

    //store certificate or diploma action that is utilized in the edit view for education parent
    public function storeCertificateDiploma(Request $request){

        $completed_month_year_format = (ControllerHelpers::returnMonthYear($request->input('completed_month_year_preformat')));
        //nifty way to append key/values to request array
        $request->request->add(['completed_month_year_format' => $completed_month_year_format]);

        $this->degree->create($request->all());

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Certificate or Degree Successfully Added!'));
    }

    //edit degree or certificate action view
    public function editDegreeCertificate($id, DegreeRepositoryInterface $degreeRepo){

        $degree = $degreeRepo->get($id);

        return view('education.degree.edit-degree-certificate', compact('degree'));
    }

    //update degree or certificate action post action
    public function updateDegreeCertificate(Request $request, $id, DegreeRepositoryInterface $degreeRepo){

        $completed_month_year_format = (ControllerHelpers::returnMonthYear($request->input('completed_month_year_preformat')));
        //nifty way to append key/values to request array
        $request->request->add(['completed_month_year_format' => $completed_month_year_format]);

        $degree_cert = $degreeRepo->get($id);

        //update all of the project attributes
        $degree_cert->update($request->all());

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Degree or Certificate Successfully Updated!'));
    }

}
