<?php

namespace App\Http\Controllers;

use App\Education;

use App\Degree;

use App\Award;

use App\Personal;

use Illuminate\Http\Request;

use App\Http\Requests\MakeAwardRequest;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Repositories\Personal\PersonalRepositoryInterface;

use App\Repositories\Award\AwardRepositoryInterface;
use App\Repositories\Award\AwardRepository;

use App\Repositories\Degree\DegreeRepositoryInterface;
use App\Repositories\Degree\DegreeRepository;

use Image;
use App\Repositories\Image\ImageRepository;

use App\Repositories\Education\EducationRepositoryInterface;
use App\Repositories\Education\EducationRepository;

class EducationController extends Controller
{

    protected $education;
    protected $award;
    protected $currentUser;
    protected $degree;
    protected $image;

    public function __construct(Education $edu, Award $award, Degree $degree, Image $img)
    {
        // set the model
        $this->award = new AwardRepository($award);
        $this->degree = new DegreeRepository($degree);
        $this->image = new ImageRepository($img);
        $this->education = new EducationRepository($edu);

        //set currently logged in user
        $this->middleware(function ($request, $next){
            $this->currentUser = auth()->user()->id;
            return $next($request);
        });

    }

    //education index action
    public function index(PersonalRepositoryInterface $personalRepo,
                          EducationRepositoryInterface $eduRepo,
                          AwardRepositoryInterface $awardRepo)
    {

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        $education = $eduRepo->find($personal_id);

        $awards = $awardRepo->find($personal_id);

        return view('education.education-index', compact('education', 'awards'));
    }

    //education create action
    public function create(PersonalRepositoryInterface $personalRepo) {

        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        return view('education.create-education', compact('personal_id'));

    }

    //education store action
    public function store(Request $request) {

        $start_month_year_format = ($this->returnMonthYear($request->input('start_month_year_preformat')));
        $end_month_year_format = ($this->returnMonthYear($request->input('end_month_year_preformat')));

        //nifty way to append key/values to request array
        $request->request->add(['start_month_year_format' => $start_month_year_format, 'end_month_year_format' => $end_month_year_format]);

        if($request->hasFile('image_file')){
            //params for storeImage: $request, $fileKey, $fileName, $path
            $this->image->storeImage($request, 'image_file', $request['logo'], 'images/education');
        }

        $this->education->create($request->all());

        //redirect back with message for users!
        Session::flash('message', 'Education Successfully Added!');
        return redirect('/education');

    }

    //edit education view action
    public function edit($id,
                         PersonalRepositoryInterface $personalRepo,
                         EducationRepositoryInterface $eduRepo
                        )
    {

        $personal = $personalRepo->find($this->currentUser);
        $personal_id = $personal->id;
        //TODO modify forms so that this is not necessary in the edit form for education
        // (degree not necessary since it is related to education record)

        //get education collection
        $education = $eduRepo->get($id);

        //get degrees & certs from education collection
        $degrees = $education->education_degrees;
        $certificates = $education->education_certificates;

        return view('education.edit-education', compact('education', 'degrees', 'certificates', 'personal_id'));
    }

    //edit education update action
    public function update(Request $request, $id)
    {
        $start_month_year_format = ($this->returnMonthYear($request->input('start_month_year_preformat')));
        $end_month_year_format = ($this->returnMonthYear($request->input('end_month_year_preformat')));

        //nifty way to append key/values to request array
        $request->request->add(['start_month_year_format' => $start_month_year_format, 'end_month_year_format' => $end_month_year_format]);

        //handy array_filter method removes any unset values from request associative array
        $filterRequest = array_filter($request->all());

        $this->education->update($filterRequest, $id);

        if($request->hasFile('image_file')){
            //params for storeImage: $request, $fileKey, $fileName, $path
            $this->image->storeImage($request, 'image_file', $request['logo'], 'images/education');

        }

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Education Successfully Updated!'));
    }

    //store certificate or diploma action that is utilized in the edit view for education parent
    public function storeCertificateDiploma(Request $request){

        $completed_month_year_format = ($this->returnMonthYear($request->input('completed_month_year_preformat')));
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

        $completed_month_year_format = ($this->returnMonthYear($request->input('completed_month_year_preformat')));
        //nifty way to append key/values to request array
        $request->request->add(['completed_month_year_format' => $completed_month_year_format]);

        $degree_cert = $degreeRepo->get($id);

        //update all of the project attributes
        $degree_cert->update($request->all());

        //redirect back
        return Redirect::back()->with(Session::flash('message', 'Degree or Certificate Successfully Updated!'));

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

    //format a passed year & month (e.g. 2020-09 becomes Sep 2020)
    private function returnMonthYear($date){

        //work around to tack on day at end of passed request date
        $pre_date_str = $date.'-01';

        //format given date to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $monthYear = date('M Y', strtotime($pre_date_str));

        return $monthYear;

    }

}
