<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'education';

    protected $fillable = ['personal_id', 'education_id', 'school_name', 'details', 'start_month_year_preformat', 'start_month_year_format', 'end_month_year_preformat', 'end_month_year_format', 'logo'];

    public function scopeEducation($query,$personal_id){
        return $query->where('personal_id', '=', $personal_id)->get();
    }

    //since you can have more than one degree from one school
    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }

    // return the degrees for
    public function education_degrees() {
        return $this->degrees()->where('degree_or_certificate','=', 'degree');
    }

    // return the degrees for
    public function education_certificates() {
        return $this->degrees()->where('degree_or_certificate','=', 'certificate');
    }

    //establish that education belongs to one person
    public function personal() {
        return $this->belongsTo(Personal::class);
    }
}
