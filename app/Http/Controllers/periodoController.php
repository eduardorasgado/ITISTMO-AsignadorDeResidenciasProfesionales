<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
