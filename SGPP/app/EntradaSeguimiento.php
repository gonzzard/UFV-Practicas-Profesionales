<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaSeguimiento extends Model
{
    public function asignacion()
    {
        return $this->belongsTo('App\Asignacion');
    }
}
