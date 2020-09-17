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

use App\Repositories\Education\EducationRepositoryInterface;
use App\Repositories\Education\EducationRepository;



class EducationController extends Controller
{

    protected $award;
    protected $currentUser;
    protected $degree;

    public function __construct(Award $award, Degree $degree)
    {
        // set the model
        $this->award = new AwardRepository($award);
        $this->degree = new DegreeRepository($degree);


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

        $edu = new Education();

        $edu->personal_id = $request->input('personal_id');
        $edu->school_name = $request->input('school_name');

        //get the file from the edit post page request...
        $file = $request->file('logo');

        //set the file name
        $filename = uniqid(). $file->getClientOriginalName();

        //move the file to correct location
        $file->move('images/', $filename);

        //here is where I need to add the thumbnail also....
      //  $thumb_string="thmb-".$filename;

        //image intervention creating different sized images
      //  Image::make( public_path('images/'.$filename))->resize(430, 296)->save('images/'.$thumb_string);

        //save school/institution logo filename to db
        $edu->logo = $filename;


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
    public function edit($id,
                         PersonalRepositoryInterface $personalRepo,
                         EducationRepositoryInterface $eduRepo)
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

        //add some error handling
        $edu = Education::findOrFail($id);

        //update all of the project attributes
        $edu->update($request->all());

        $filename = '';

        if($request->hasFile('logo')){

            $updatedImg = $request->file('logo');
            $filename = uniqid(). $updatedImg->getClientOriginalName();
            $updatedImg->move('images/', $filename);

            //TODO: add this if I find I want to add predefined dimensions for logo
//            $thumb_string="md-img-".$filename;
//            Image::make( public_path('images/'.$filename))->resize(600, 270)->save('images/'.$thumb_string);
        }

        if($filename > 0 ){
            $edu->logo = $filename;
        }


        //TODO: add check here for if preformat has change for both start and end.  Extract this to its own method?
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
        $pre_end_date_str = $date.'-01';

        //format $pre_end_date_month_year to store only month and year in neat format
        // i.e. 'Aug 2017' or 'Dec 2012' etc.
        $monthYear = date('M Y', strtotime($pre_end_date_str));

        return $monthYear;

    }

}
