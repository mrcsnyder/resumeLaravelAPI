<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'education';

    protected $fillable = ['school_name', 'details', 'start_month_year', 'end_month_year'];

}
