<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaPracticas extends Model
{
    public function criterioEncuestaPracticas()
    {
        return $this->belongsTo('App\CriterioEncuestaPractica');
    }

    public function asignacion()
    {
        return $this->belongsTo('App\Asignacion');
    }
}
