<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    //
    protected $table ='awards';

    protected $fillable = ['personal_id', 'award_name', 'award_type', 'date_range', 'awarded_by'];

    //establish that awards belongs to one person
    public function personal() {
        return $this->belongsTo(Personal::class);
    }


}
