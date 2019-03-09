<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    public function users() {
        return $this->hasMany('App\User');
    }

    public function responsable()
    {
        return $this->hasOne('App\User', 'responsable_id');
    }
}
