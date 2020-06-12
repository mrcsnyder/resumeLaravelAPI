<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    //
    protected $table = 'personal';

    protected $fillable = ['name', 'current_role', 'profile_image', 'resume', 'professional_intro', 'hobbies_interests'];


    public function education()
    {
        return $this->hasMany(Education::class)->with('degrees');
    }

    public function work()
    {
        return $this->hasMany(Work::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }


}
