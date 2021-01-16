<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{

    protected $table = 'personal';

    protected $fillable = ['user_id', 'name', 'current_role', 'profile_image', 'resume', 'linkedin', 'git_source','professional_intro', 'hobbies_interests'];

    public function scopePersonal($query,$user_id){
        return $query->where('user_id', '=', $user_id);
    }

    public function education()
    {
        return $this->hasMany(Education::class)->with('education_degrees', 'education_certificates');
    }

    public function work()
    {
        return $this->hasMany(Work::class)->orderBy('created_at', 'desc');
    }

    //awards parent and types
    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function scholarships()
    {
        return $this->awards()->where('award_type','=','scholarship');
    }

    public function honors()
    {
        return $this->awards()->where('award_type','=','honor_roll');
    }

    //skills parent and categories
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function coding_skills(){

        return $this->skills()->where('category','=', 'coding');
    }

    public function methods_devops_skills(){

        return $this->skills()->where('category','=', 'methods_devops');
    }

    public function software_skills(){

        return $this->skills()->where('category','=', 'software');
    }

    public function operating_systems_skills(){

        return $this->skills()->where('category','=', 'operating_systems');
    }

    public function business_skills(){

        return $this->skills()->where('category','=', 'business');
    }


    public function projects()
    {
        return $this->hasMany(Project::class)->with('images');
    }



}
