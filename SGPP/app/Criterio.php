<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    public function practica()
    {
        return $this->belongsTo("App\Practica");
    }

    public function evaluacions()
    {
        return $this->hasMany('App\Evaluacion');
    }
}
