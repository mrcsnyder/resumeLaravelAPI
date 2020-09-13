<?php

namespace App\Repositories\PDF;

interface PDFRepositoryInterface
{

    public function storePDF($request, $fileKey, $path);

}
