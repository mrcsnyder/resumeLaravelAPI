<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $table = 'skills';

    protected $fillable = [
        'personal_id',
        'skill',
        'category',
        'rating',
    ];

    //establish that skills belongs to one person
    public function personal() {
        return $this->belongsTo(Personal::class);
    }
}
