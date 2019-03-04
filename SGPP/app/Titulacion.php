<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    public function practicas() {
        return $this->hasMany('App\Practica');
    }
}
