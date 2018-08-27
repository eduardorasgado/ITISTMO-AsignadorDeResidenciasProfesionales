<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
		//adding fillables
		protected $fillable = [
				'name',
				'estado',
		]; 
    public function sinodalia()
    {
    	return $this->hasMany('App\Sinodalia', 'periodo_id', 'id');
    }
}
