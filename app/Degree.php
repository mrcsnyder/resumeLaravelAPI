<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{

   protected $table = 'degrees';

    protected $fillable = ['education_id',
        'degree_or_certificate',
        'major',
        'honors_info',
        'gpa',
        'completed_month_year_preformat',
        'completed_month_year_format'
    ];

    public function scopeDegree($query,$personal_id){
        return $query->where('personal_id', '=', $personal_id)->get();
    }

//establish that a degree/certificate belongs to one project
    public function education() {
        return $this->belongsTo(Education::class);
    }

}
