<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sinodalia;
use App\User;

class SinodaliaController extends Controller
{
    public function create(Request $request, Sinodalia $sinodalia)
    {
    	$theUser = User::find($request->presidente);
    	
    	// creando la sinodalia
    	$createdSinodalia = $theUser->sinodalia()->create([
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
    	return response()->json($sinodalia->with('user')->find($createdSinodalia));
    }
}
