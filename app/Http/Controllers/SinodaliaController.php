<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Sinodalia;
use App\User;
use App\Periodo;
use DB;
use Auth;
class SinodaliaController extends Controller
{
        public function index(Request $request, Sinodalia $sinodalia)
        {
            // evitar acceso de maestros y secretaria
            if (Auth::user()->cargo != 0){
                return view('home');
            }
            $allSinodalias = Sinodalia::where('aprobacion', '!=', 1)->get();

            return response()->json([
                'sinodalias' => $allSinodalias,
            ]);
        }
    public function create(Request $request, Sinodalia $sinodalia, Periodo $periodo)
    {
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        /*
            DB::updated in
            https://www.tutorialspoint.com/laravel/update_records.htm
        */
        // presidente
        $theUser = User::find($request->presidente);
        $asignaciones = $theUser->num_asignaciones + 1;
        // nuevo numero de asignaciones a presidente
        DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones, $theUser->id]);
        // volver a solicitarlo ya actualizado
        // $theUser = User::find($request->presidente);
        
        //secretario
        $theUserSecretario = User::find($request->secretario);
        $asignaciones2 = $theUserSecretario->num_asignaciones + 1;
        // nuevo numero de asignaciones a presidente
        DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones2, $theUserSecretario->id]);
        // $theUserSecretario = User::find($request->secretario);
        //vocal
        $theUserVocal = User::find($request->vocal);
        $asignaciones3 = $theUserVocal->num_asignaciones + 1;
        // nuevo numero de asignaciones a presidente
        DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones3, $theUserVocal->id]);
        // $theUserVocal = User::find($request->vocal);
        //vocal suplente
        $theUserSuplente = User::find($request->vocalSuplente);
        $asignaciones4 = $theUserSuplente->num_asignaciones + 1;
        // nuevo numero de asignaciones a presidente
        DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones4, $theUserSuplente->id]);
        $theUserSuplente = User::find($request->vocalSuplente);
        
        // periodo
        $thePeriodo = Periodo::find($request->periodo);
        // creando la sinodalia
        $createdSinodalia = $theUser->sinodalia()->create([
                'residente' => $request->residente,
                'periodo_id' => $thePeriodo->id,
                'carrera' => $request->carrera,
                'num_control' => $request->num_control,
                'proyecto' => $request->proyecto,
                'proyecto_aprobacion' => 0,
                'id_secretario' => $request->secretario,
                'id_vocal' => $request->vocal,
                'id_vocal_sup' => $request->vocalSuplente,
                'aprobacion' => 0,
        ]);
        // regresar una respuesta
        return response()->json($sinodalia->with('user')->find($createdSinodalia));
    }

    // muestra el sinodal en la tarjeta
    public function showSinodal(Request $request, Sinodalia $sinodalia)
    {
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        
        // funcion de a misma clase en utitities
        $data = $this->sinodalCard($request);

        // extrayendo del array que retorna la
        // funcion que procesa
        $mySinodalia = $data[0]['mySinodalia'];

        return view('sinodal', 
            compact('mySinodalia'), [
                'presidente' => $data[1]['presidente']->name,
                'secretario' => $data[1]['secretario']->name,
                'vocal' => $data[1]['vocal']->name,
                'vocalsuplente' => $data[1]['vocalsuplente']->name,
            ]);
        
    }

    public function permisoParaEditar(Request $request)
    {
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        // obtener el id de la sinodalia
        $id = $request->id;

        return view('sinodalias.permisoSino',[
                            'id' => $id
                        ]);
    }

    // se llama por post despues de solicitar el permiso
    public function verifyAdmin(Request $request)
    {
        try {
            // evitar acceso de maestros y secretaria
            if (Auth::user()->cargo != 0){
                return view('home');
            }
            if (!isset($request->pass)) {
                return view('home');
            }
            // verificar si los pass son correctos
            $passView = $request->pass;
            $hashedPassword = Auth::user()->password;
            if (Hash::check($passView, $hashedPassword))
            {
                // The passwords match...
                // funcion de a misma clase en utitities
                $data = $this->sinodalCard($request);
                
                // extrayendo del array que retorna la
                // funcion que procesa
                $mySinodalia = $data[0]['mySinodalia'];

                // todos los maestros
                $allTeachers = User::where('cargo', '!=', 1)->get();

                return view('sinodalias.editarSino', 
                    compact('mySinodalia'), [
                        'presidente' => $data[1]['presidente'],
                        'secretario' => $data[1]['secretario'],
                        'vocal' => $data[1]['vocal'],
                        'vocalsuplente' => $data[1]['vocalsuplente'],
                        'allTeachers' => $allTeachers,
                    ]);
            }
            // en otro caso mandar ahi mismo con un
            // mensaje
            return redirect()->back()->withSuccess("Contraseña incorrecta");

        } catch(Exception $error){
            return view('home');
        }
    }

    public function updateSinodalia(Request $request)
    {
        // evitar acceso de maestros y secretaria
        if (Auth::user()->cargo != 0){
            return view('home');
        }
        // comparando el hidden id de editarSino blade
        // con el que viene en el url
        $idSino = $request->id;
        $idSinoComp = $request->id2;
        if ($idSino != $idSinoComp) {
            // testear esta posibilidad
            return redirect()->back()->withSuccess("Algo salió mal, regresa al incio y vuelve a intentarlo, por favor.");
        }
        // todo sale bien se procede a hacer el cambio
        
        $residente = $request->residente;
        $num_control = $request->num_control;
        $proyecto = $request->proyecto;
        $carrera = $request->carrera;
        $presidente = $request->presidente;
        $secretario = $request->secretario;
        $vocal = $request->vocal;
        $vocalsuplente = $request->vocalsuplente;

        // return dd([$residente, $num_control, $proyecto, $carrera, $presidente, $secretario, $vocal, $vocalsuplente]);

        // cambiar el numero de asignaciones, +o-
        $this->teacherAsignacionesChange($idSino, $presidente, $secretario, $vocal, $vocalsuplente);

        try{
            // actualizar con nuevos datos
            DB::update('update sinodalias set user_id = ?, residente = ?, carrera = ?, num_control = ?, proyecto = ?, id_secretario = ?, id_vocal = ?, id_vocal_sup = ? where id = ?',[$presidente, $residente, $carrera, $num_control, $proyecto, $secretario, $vocal, $vocalsuplente, $idSino]);
        } catch(Exception $error) 
        {
            return view("errors.errorCustom");
        }

        // regresar a la tarjeta del sinodal
        // return "cambios guardados";
        $data = $this->sinodalCard($request);

        // extrayendo del array que retorna la
        // funcion que procesa
        $mySinodalia = $data[0]['mySinodalia'];

        return view('sinodal', 
            compact('mySinodalia'), [
                'presidente' => $data[1]['presidente']->name,
                'secretario' => $data[1]['secretario']->name,
                'vocal' => $data[1]['vocal']->name,
                'vocalsuplente' => $data[1]['vocalsuplente']->name,
            ]);
    }
    public function updateAprobacionProyecto(Request $request)
    {
        try 
        {
            // evitar acceso de maestros y secretaria
            if (Auth::user()->cargo != 0){
                return view('home');
            }
            if (!isset($request->pass)) {
                return view('home');
            }
            // verificar si los pass son correctos
            $passView = $request->pass;
            $hashedPassword = Auth::user()->password;
            if (Hash::check($passView, $hashedPassword))
            {
                // si las passwords coinciden
                $idSinodal = $request->id;
                // $theUpdate = Sinodal::find($idSinodal);
                DB::update('update sinodalias set proyecto_aprobacion = ? where id = ?',[1, $idSinodal]);
                return redirect()->back()->withSuccess('Aprobaste el anteproyecto');
            }
            else {
                return redirect()->back()->withSuccess('Contraseña incorrecta');
            }
        } catch (Exception $error)
        {
            // en caso de no haber conexion
            return redirect()->back()->withSuccess('Un error ha ocurrido, intentalo mas tarde');
        }
        // ningun caso
        return view('admin');
    }
    public function updateAprobacionFinal()
    {
        return 'Aprobado';
    }

    // UTILIDADES ---------------
    private function sinodalCard($request)
    {
        // buscar la sinodalia con el id
        $mySinodalia = Sinodalia::find($request->id);

        // buscar el id de los representantes de
        // esa sinodalia
        $idPresidente = $mySinodalia->user_id;
        $idSecretario = $mySinodalia->id_secretario;
        $idVocal = $mySinodalia->id_vocal;
        $idSup = $mySinodalia->id_vocal_sup;

        //traer los objetos de esos represnetantes
        $presidente = User::find($idPresidente);
        $secretario = User::find($idSecretario);
        $vocal = User::find($idVocal);
        $vocalsuplente = User::find($idSup);
        return [
            compact('mySinodalia'),
            [
                'presidente' => $presidente,
                'secretario' => $secretario,
                'vocal' => $vocal,
                'vocalsuplente' => $vocalsuplente
            ],
        ];
    }

    private function teacherAsignacionesChange($id, $p, $s, $v, $vs)
    {
        // metodo para cambiar el numero de asignacions
        // de los profesores involucrados
        //encontrar la sinodalia con el id
        $OldSinodalia = Sinodalia::find($id);
        
        $oldPresident = $OldSinodalia->user_id;
        $oldSecretario = $OldSinodalia->id_secretario;
        $oldVocal = $OldSinodalia->id_vocal;
        $oldVS = $OldSinodalia->id_vocal_sup;
        
        //lista de los pasados 
        $oldGuys = [$oldPresident, $oldSecretario, $oldVocal, $oldVS];

        // meter a todos en un arreglo
        // presidente, seecretario, vocal, vocalsuplente
        $guys = [User::find($p), User::find($s), User::find($v), User::find($vs)];

        // iterar para checkear cambios
        for ($i = 0; $i < count($guys); $i++)
        { 
            if($guys[$i]->id != $oldGuys[$i])
            {
                // quitandole asignaciones a old
                $theUser= User::find($oldGuys[$i]);
                $asignaciones = $theUser->num_asignaciones - 1;
                // nuevo numero de asignaciones a presidente
                DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones, $oldGuys[$i]]);

                //agregando asignaciones a new
                $asignaciones = $guys[$i]->num_asignaciones + 1;
                // nuevo numero de asignaciones a presidente
                DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones, $guys[$i]->id]);
            }
        }
        return true;
    }
}