<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinodaliaController extends Controller
{
    public function create(Request $request)
    {
    	// creando la sinodalia
    	$createdSinodalia = $request->user()->sinodalia()->create([
    			'residente' => $request->residente,
    			'carrera' => $request->carrera,
    			'num_control' => $request->num_control,
    			'proyecto' => $request->proyecto,
    			'id_secretario' => $request->secretario,
    			'id_vocal' => $request->vocal,
    			'id_vocal_sup' => $request->vocalSuplente,
    			'aprobacion' => 0,
    	]);

    	// regresar una respuesta
    	return 'Sinodalia creada';
    }
}
