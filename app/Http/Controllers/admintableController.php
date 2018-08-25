<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class admintableController extends Controller
{
    public function index()
    {
    	return view('admin');
    }

    public function teachers(Request $request, User $user) {
    	$teachers = [];
    	return response()->json([
    		'teachers' => $teachers,
    	]);
    }
}
