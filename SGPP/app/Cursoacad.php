<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursoacad extends Model
{
    public function practicas() {
        return $this->hasMany('App\Practica');
    }
}
