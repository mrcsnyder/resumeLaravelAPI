<?php

namespace App\Repositories\Image;

//Intervention Image package dependency (see config/app.php)
//utilize with this when creating more functions to generate thumbnails, etc.?
use Image;

class ImageRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model) {
        $this->model = $model;
    }

    //potentially make this more generic
    public function storeImage($request, $fileKey, $fileName, $path) {

    if($request->hasFile($fileKey)){

        //get the file from the profile_image request...
        $image = $request->file($fileKey);

        //move the file to correct location
        $image->move($path, $fileName);

    }

    else {
        return false;
    }



    }


}
