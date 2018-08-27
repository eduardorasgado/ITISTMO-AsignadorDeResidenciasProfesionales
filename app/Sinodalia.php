<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinodalia extends Model
{
	// protected $primaryKey = 'id_presidente';
	protected $fillable = ['residente',
												'periodo_id',
												'carrera',
												'num_control',
												'proyecto',
												'proyecto_aprobacion',
												// 'id_presidente',
												'id_secretario',
												'id_vocal',
												'id_vocal_sup',
												'aprobacion',
	];
    public function user() 
    {
    	return $this->belongsTo(User::class);
    }

    public function periodo()
    {
    	return $this->belongsTo('App\Periodo', 'id', 'periodo_id');
    }
}
