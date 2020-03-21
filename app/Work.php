<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //

    protected $table = 'work';

    protected $fillable = [
        'role',
        'company_name',
        'description',
        'start_date_month_year_preformat',
        'start_date_month_year_format',
        'end_date_month_year_preformat',
        'end_date_month_year_format'

    ];



}
