<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    protected $table = 'work';

    protected $fillable = [
        'personal_id',
        'role',
        'company_name',
        'description',
        'start_date_month_year_preformat',
        'start_date_month_year_format',
        'end_date_month_year_preformat',
        'end_date_month_year_format'
    ];

    public function scopeWork($query,$personal_id){
        return $query->where('personal_id', '=', $personal_id)->get();
    }

    //establish that work history belongs to one person
    public function personal() {
        return $this->belongsTo(Personal::class);
    }

}
