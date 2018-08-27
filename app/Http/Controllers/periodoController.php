<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePeriodoRequest;
use Auth;
use App\Sinodalia;
use App\Periodo;

class periodoController extends Controller
{
		public function index()
		{
			// evitar acceso de maestros y secretaria
			if (Auth::user()->cargo != 0){
				return view('home');
			}
			return view('periodo');
		}

		// confirmar existencia de periodos
		public function confirm()
		{
			// evitar acceso de maestros y secretaria
			if (Auth::user()->cargo != 0){
				return view('home');
			}
			$periodos = Periodo::where('estado','=',1)->get();

			return response()->json([
				'periodos' => $periodos,
			]);
		}

		// crear un nuevo periodo
		public function create(CreatePeriodoRequest $request) {
			// solo si es el usuario con cargo de asignador
			if ($request->user()->cargo != 0) {
				return view('home');
			}
			// estado 1 = activo
			// estado 0 = cerrado
			$newPeriodo = Periodo::create([
				'name' => $request->input('name'),
				'estado' => 1,
			]);
			return redirect('/periodo')->withSuccess("El periodo ".$newPeriodo->name." se ha creado con éxito");
		}

		public function availables() {
			// evitar acceso de maestros y secretaria
			if (Auth::user()->cargo != 0){
				return view('home');
			}
			return 'hola';
		}
}

