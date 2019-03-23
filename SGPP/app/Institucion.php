<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    public function tutoresInst() {
        return $this->hasMany('App\User');
    }

    public function responsable()
    {
        return $this->belongsTo('App\User');
    }

    public function titulacion()
    {
        return $this->belongsTo('App\Titulacion');
    }
}
