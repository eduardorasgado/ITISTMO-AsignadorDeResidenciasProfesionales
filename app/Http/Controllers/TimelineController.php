<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TimelineController extends Controller
{
	public function index()
	{
		$userCargo = Auth::user()->cargo;
		if ($userCargo) {
			// en caso de ser profesor o secretaria
			return view('home');
		}
		// en caso de ser administrador
		return view('admin');
	}
}