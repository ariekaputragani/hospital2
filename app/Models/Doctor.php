<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['pp','poli_id','name','slug','desc','birthdate','phone','email','address',
    'sen_start','sen_end',
    'sel_start','sel_end',
    'rab_start','rab_end',
    'kam_start','kam_end',
    'jum_start','jum_end',
    'sab_start','sab_end',    
];

    public function poli() {
        return $this->belongsTo(Poli::class);
    }
    public function getTakeImageAttribute() {
        return "/storage/" . $this->pp;
    }
}
