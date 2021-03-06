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
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        // sending all teachers to frontend
        $users = User::all();
        return view('teachers.teacherList', compact('users'));
    }

    public function editarTeacher(Request $request)
    {
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        $id = $request->id;
        $user = User::find($id);
        // $msg = "El id del profesor es: " . $id;
        return view('teachers.editTeacher',[
            'id' => $id,
            'user' => $user,
        ]);
    }

    public function update(Request $request){
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        $integrante = User::find($request->idTeacher);
        // return $request->idTeacher;
        // alterando los datos del user
        $integrante->name = $request->name;
        $integrante->num_control = $request->num_control;
        $integrante->telefono = $request->telefono;
        $integrante->cargo = $request->cargo;
        // guardando los cambios
        $integrante->save();
        // redireccionando a la lista de profesores
        return redirect('/teachersPanel')->with('userChanged','El integrante '.$request->name.' ha sido correctamente editado.');
    }

    public function delete(Request $request){
        // eliminar un usuario
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        $user = User::findOrFail($request->id);
        // si el profesor tiene asignaciones
        if ($user->num_asignaciones > 0) {
            // no se puede borrar
            return redirect()->back()->with('cannotDeleted','El/La integrante '.$user->name.' no puede ser eliminado/a, tiene sinodalias pendientes.');
        }
        // en caso de que el profesor no tenga asign
        //borrando al usuario
        $user->delete();

        return redirect()->back()->with('userDeleted','El/La integrante '.$user->name.' ha sido eliminado/a.');
    }

    public function historialIndex(){
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        return 'Its me';
    }
}
