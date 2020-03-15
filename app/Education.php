<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'education';

    protected $fillable = ['school_name', 'details', 'start_month_year', 'end_month_year'];

    //since you can have more than one degree from one school
    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }

}
