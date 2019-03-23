<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    public function practicas() {
        return $this->hasMany('App\Practica');
    }

    public function director()
    {
        return $this->belongsTo('App\User');
    }

    public function titulacionPrincipal()
    {
        return $this->belongsTo('App\Titulacion');
    }

    public function menciones()
    {
        return $this->hasMany('App\Titulacion');
    }

    public function instituciones()
    {
        return $this->hasMany('App\Institucion');
    }
}
