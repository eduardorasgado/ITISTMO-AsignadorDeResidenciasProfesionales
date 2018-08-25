<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admintableController extends Controller
{
    public function index()
    {
    	return view('admin');
    }
}
