<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    public function sinodalia()
    {
    	$this->hasMany(Sinodalia::class);
    }
}
