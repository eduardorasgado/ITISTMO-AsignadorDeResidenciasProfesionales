<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}

