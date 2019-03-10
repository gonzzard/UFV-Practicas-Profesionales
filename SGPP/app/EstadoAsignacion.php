<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadoasignacion extends Model
{
    public function asignacion()
    {
        return $this->hasOne("App\Asignacion");
    }
}
