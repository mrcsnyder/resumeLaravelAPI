<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    //

    protected $table = 'images';

    protected $fillable = ['file_name', 'description', 'main_img'];


    //establish that an image belongs to one project
    public function project() {
        return $this->belongsTo(Project::class, 'id');
    }
}
