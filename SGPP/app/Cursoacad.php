<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursoacad extends Model
{
    protected $fillable = [
        'denominacion', 'activo', 'titulacion_id'
    ];

    public function practicas() {
        return $this->hasMany('App\Practica');
    }    
}
