<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
                    'name',
                    'email',
                    'cargo',
                    'disponibilidad',
                    'num_asignaciones',
                    'anteproyecto_cuenta',
                    'proyecto_cuenta',
                    'num_control',
                    'telefono',
                    'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sinodalias() 
    {
        return $this->hasMany(Sinodalias::class);
    }
}
