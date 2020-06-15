<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';

    protected $fillable = ['personal_id', 'title', 'full_detail', 'project_url', 'project_repo'];

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

    //establish that projects belongs to one person
    public function personal() {
        return $this->belongsTo(Personal::class);
    }


}
