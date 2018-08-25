<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    // protected $primaryKey = 'id';

    public function sinodalia() 
    {
        return $this->hasMany(Sinodalia::class);
    }

    public function addOne(User $user)
    {
        $newNum = $user->num_asignaciones + 1;
        
        DB::table('users')
            ->where('users.id', '=', $user->id)
            ->update(['users.num_asignaciones' => $newNum ]);
    }
}
