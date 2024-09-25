<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['name'];

    public function doctors() {
        return $this->hasMany(Doctor::class);
    }
}