<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellido1', 'apellido2', 'email', 'password', 'docIdentificacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function institution() {
        return $this->belongsTo('App\Institucion');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function titulacion()
    {
        return $this->hasOne('App\Titulacion', 'director_id');
    }

    public function institucion_resp()
    {
        return $this->hasOne('App\Institucion', 'responsable_d');
    }

    public function asignaciones()
    {
        return $this->hasMany('App\Asignacion');
    }

    public function asignacionesTutorAcad()
    {
        return $this->hasMany('App\Asignacion');
    }

    public function asignacionesTutorInst()
    {
        return $this->hasMany('App\Asignacion');
    }

    public function delete()
    {
        $titulacion = $this->titulacion;

        if(isset($titulacion))
        {
            $titulacion->director()->dissociate()->save();
        }

        $this->roles()->delete();

        $institucion = $this->institution;

        if(isset($institucion))
        {
            $institucion->dissociate()->save();
        }
        
        return parent::delete();
    }

    /*
    *   @param string | array $roles
    */
    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'No autorizado');
        }
        return $this->hasRole($roles) || abort(401, 'No autorizado');
    }

    /*
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('nombre', $roles)->first();
    }

    /*
    * Check one role
    * @param string $role
    */
    public function hasRole($role) {
        return null !== $this->roles()->where('nombre', $role)->first();
    }

}
