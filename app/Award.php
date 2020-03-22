<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    //
    protected $table ='awards';

    protected $fillable = ['award_name', 'award_type', 'date_range', 'awarded_by'];



}