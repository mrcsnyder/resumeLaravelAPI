<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personal;

//Intervention Image
use Image;

use App\Repositories\Personal\PersonalRepositoryInterface;
use App\Repositories\Personal\PersonalRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\PDF\PDFRepository;
use App\Http\Requests\MakePersonalRequest;
use App\Http\Requests\EditPersonalRequest;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PersonalController extends Controller
{

    protected $model;
    protected $image;
    protected $pdf;

    public function __construct(Personal $personal, Image $img)
    {
        // set the model
        $this->model = new PersonalRepository($personal);
        $this->image = new ImageRepository($img);
        $this->pdf = new PDFRepository();

    }

    //personal index view action
    public function index(PersonalRepositoryInterface $personalRepo){

       //get currently signed in user
       $user_id = $this->getCurrentUser();

        //possibly a neater way to do this, but it is working good
        //see PersonalRepository method
        $personal = $personalRepo->find($user_id);

        return view('personal.personal-index', compact('personal'));
    }

    //personal create view action
    public function create(){

        //get currently signed in user
        $user_id = $this->getCurrentUser();

        return view('personal.create-personal', compact('user_id'));
    }

    // store personal post action
    public function store(MakePersonalRequest $request){

        //handy array_filter method removes any unset values from request associative array
        $filterRequest = array_filter($request->all());

        if($request->hasFile('image_file')){
            //params for storeImage: $request, $fileKey, $fileName, $path
            $this->image->storeImage($request, 'image_file', $request['profile_image'], 'images/personal');
        }

        if($request->hasFile('pdf_file')) {

            //params for storePDF: $request, $fileKey, $fileName
            $this->pdf->storePDF($request, 'pdf_file', 'pdf-resume');

        }

        $this->model->create($filterRequest);

        //redirect back with message for users!
        Session::flash('message', 'Personal Details Successfully Added!');
        return redirect('/personal');
    }

// edit personal view action
public function edit(PersonalRepositoryInterface $personalRepo){

        //get currently signed in user
        $user_id = $this->getCurrentUser();

        //get user based on passed currently logged in user's id
        $personal = $personalRepo->find($user_id);

        return view('personal.edit-personal', compact('personal', 'user_id'));

}

public function update(EditPersonalRequest $request, $id){

    //handy array_filter method removes any unset values from request associative array
    $filterRequest = array_filter($request->all());

    $this->model->update($filterRequest, $id);

    if($request->hasFile('image_file')){
        //params for storeImage: $request, $fileKey, $fileName, $path
        $this->image->storeImage($request, 'image_file', $request['profile_image'], 'images/personal');

    }

    if($request->hasFile('pdf_file')) {

        //params for storePDF: $request, $fileKey, $fileName
        $this->pdf->storePDF($request, 'pdf_file', 'pdf-resume');

    }

    //redirect back
    return Redirect::back()->with(Session::flash('message', 'Personal Details Successfully Updated!'));

}

//get endpoint action
public function getPersonal($id){

    //get all project ids and the images
    return Personal::where('id','=',$id)->with('education', 'work', 'scholarships', 'honors', 'coding_skills', 'methods_devops_skills', 'software_skills', 'operating_systems_skills', 'business_skills', 'projects')->get();
}

// function to return user_id
private function getCurrentUser(){

    //get currently signed in user
    $user = auth()->user();

    return $user->id;
}

}
