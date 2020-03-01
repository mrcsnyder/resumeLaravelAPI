<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    protected $table = 'projects';

    protected $fillable = ['title', 'intro', 'full_detail', 'project_url', 'project_repo'];

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'id','id');

    }

}
