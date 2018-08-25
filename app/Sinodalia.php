<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinodalia extends Model
{
	protected $fillable = ['residente',
												'carrera',
												'num_control',
												'proyecto',
												'id_presidente',
												'id_secretario',
												'id_vocal',
												'id_vocal_sup',
												'aprobacion',
	];
    public function user() 
    {
    	return $this->belongsTo(User::class);
    }
}
