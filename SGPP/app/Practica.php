<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    public function cursoacad(){
        return $this->belongsTo('App\Cursoacad');
    }

    public function titulacion() {
        return $this->belongsTo('App\Titulacion');
    }

    public function criterios() {
        return $this->hasMany('App\Criterio');
    }

    public function asignaciones() {
        return $this->hasMany('App\Asignacion');
    }

    public function criterioEncuestaPracticas() {
        return $this->hasMany('App\CriterioEncuestaPractica');
    }
}
