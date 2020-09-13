<?php

namespace App\Repositories\Image;

interface ImageRepositoryInterface
{

    public function storeImage($request, $fileKey, $fileName, $path);

}
