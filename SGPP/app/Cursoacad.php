<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursoacad extends Model
{
    protected $fillable = [
        'denominacion', 'activo'
    ];

    public function practicas() {
        return $this->hasMany('App\Practica');
    }
}
