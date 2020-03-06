<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    protected $table = 'projects';

    protected $fillable = ['title', 'intro', 'full_detail', 'project_url', 'project_repo'];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    // return the main image for the portfolio page
    public function main_image() {
        return $this->images()->where('main_img','=', 1);
    }

    // return every other image but the main for the portfolio gallery
    public function all_other_images() {
        return $this->images()->where('main_img','=', 0);
    }



}
