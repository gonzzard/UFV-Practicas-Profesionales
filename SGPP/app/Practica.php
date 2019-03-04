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
}
