<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriterioEncuestaPractica extends Model
{
    public function practica()
    {
        return $this->belongsTo("App\Practica");
    }

    public function encuestaPracticas()
    {
        return $this->hasMany('App\EncuestaPracticas');
    }
}
