<?php

namespace App\Http\Controllers;

use App\Education;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Repositories\Personal\PersonalRepositoryInterface;

use Image;
use App\Repositories\Image\ImageRepository;

use App\Repositories\Education\EducationRepositoryInterface;
use App\Repositories\Education\EducationRepository;

class EducationController extends Controller
{

    protected $education;
    protected $currentUser;
    protected $image;

    public function __construct(Education $edu, Image $img)
    {

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
                          EducationRepositoryInterface $eduRepo)
    {

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($this->currentUser);

        $personal_id = $personal->id;

        $education = $eduRepo->find($personal_id);

        $awards = $personal->awards;

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

        //get education collection associated with id
        $education = $eduRepo->get($id);

        return view('education.edit-education', compact('education','personal_id'));
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
