<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TimelineController extends Controller
{
	public function index()
	{
		$userCargo = Auth::user()->cargo;
		return view('home')->with("cargo", $userCargo);
	}
}