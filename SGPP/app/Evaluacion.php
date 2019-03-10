<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    public function criterio()
    {
        return $this->belongsTo('App\Criterio');
    }

    public function asignacion()
    {
        return $this->belongsTo('App\Asignacion');
    }
}
