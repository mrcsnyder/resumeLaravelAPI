<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'education';

    protected $fillable = ['personal_id', 'school_name', 'details', 'start_month_year', 'end_month_year'];

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
