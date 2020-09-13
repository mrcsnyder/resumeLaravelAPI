<?php

namespace App\Repositories\PDF;

class PDFRepository implements PDFRepositoryInterface
{

    //potentially make this more generic
    public function storePDF($request, $fileKey, $path) {

        if($request->hasFile($fileKey)){

            //get the file from the profile_image request...
            $pdf = $request->file($fileKey);

            //get filename
            $pdf_filename = $pdf->getClientOriginalName();

            //move the PDF file to correct location
            $pdf->move($path, $pdf_filename);

        }

        else {
            return false;
        }

    }

}
