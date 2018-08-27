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
}
