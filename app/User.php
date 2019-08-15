<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USUARIO_ADMINISTRADOR = 'ADMINISTRADOR';

    const USUARIO_DIGITADOR = 'DIGITADOR';

    const USUARIO_VENDEDOR = 'VENDEDOR';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres','apellidos','dpi','direccion', 'telefono','email', 'password','rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

     public function esAdministrador(){

        return strtoupper($this->rol->nombre) == User::USUARIO_ADMINISTRADOR;
        
    }

    public function esDigitador(){

        return strtoupper($this->rol->nombre) == User::USUARIO_DIGITADOR;
        
    }

    public function esVendedor(){

        return strtoupper($this->rol->nombre) == User::USUARIO_VENDEDOR;
        
    }
}
