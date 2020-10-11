<?php

namespace App\Http\Utilities;

//Intervention Image package dependency (see config/app.php)
use Image;

class ImageHelpers
{

    //take image proportions, file path, and generate thumbnail
    public static function generateThumb($length, $width, $file_name, $path)
    {
        $thumb_string="thmb-".$file_name;

       return Image::make( public_path($path.$file_name))->resize($width, $length)->save($path.$thumb_string);

       // return true;
    }

}
