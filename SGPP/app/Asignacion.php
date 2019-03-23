<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    public function practica()
    {
        return $this->belongsTo("App\Practica");
    }

    public function alumno()
    {
        return $this->belongsTo("App\User");
    }

    public function tutorAcad()
    {
        return $this->belongsTo("App\User", "tutorAcad_id");
    }

    public function tutorInst()
    {
        return $this->belongsTo("App\User", "tutorInst_id");
    }

    public function estado()
    {
        return $this->belongsTo("App\Estadoasignacion");
    }

    public function asignacionAnterior()
    {
        return $this->belongsTo("App\Asignacion");
    }

    public function asignacionSiguiente()
    {
        return $this->hasOne("App\Asignacion");
    }

    public function evaluacions()
    {
        return $this->hasMany('App\Evaluacion');
    }

    public function entradasSeguimiento()
    {
        return $this->hasMany('App\EntradaSeguimiento');
    }

    public function encuestaPracticas()
    {
        return $this->hasMany('App\EncuestaPracticas');
    }
}
