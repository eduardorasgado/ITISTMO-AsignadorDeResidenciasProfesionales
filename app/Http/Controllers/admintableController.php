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

    public function teachers(Request $request, User $user) 
    {
    	// evitar acceso de maestros y secretaria
			if (Auth::user()->cargo != 0){
				return view('home');
			}
    	$teachers = User::where('cargo', '!=', 1)
                    ->orderBy('num_asignaciones', 'desc')
                    ->get();
    	return response()->json([
    		'teachers' => $teachers,
    	]);
    }

    public function teachersPanel()
    {
        // sending all teachers to frontend
        $users = User::all();
        return view('teachers.teacherList', compact('users'));
    }

    public function editarTeacher(Request $request)
    {
        $id = $request->id;
        // $msg = "El id del profesor es: " . $id;
        return view('teachers.editTeacher',[
            'id' => $id,
        ]);
    }
}
