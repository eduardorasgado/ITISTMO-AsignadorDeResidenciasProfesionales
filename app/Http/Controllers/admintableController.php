<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class admintableController extends Controller
{
    public function index()
    {
    	return view('admin');
    }

    public function teachers(Request $request, User $user) {
    	$teachers = User::where('cargo', '!=', 1)->get();
    	return response()->json([
    		'teachers' => $teachers,
    	]);
    }
}
