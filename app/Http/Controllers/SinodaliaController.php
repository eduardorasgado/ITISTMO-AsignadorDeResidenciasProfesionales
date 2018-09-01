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
        $asignaciones3 = $theUserSuplente->num_asignaciones + 1;
        // nuevo numero de asignaciones a presidente
        DB::update('update users set num_asignaciones = ? where id = ?',[$asignaciones3, $theUserSuplente->id]);
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
                'presidente' => $data[1]['presidente'],
                'secretario' => $data[1]['secretario'],
                'vocal' => $data[1]['vocal'],
                'vocalsuplente' => $data[1]['vocalsuplente'],
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
                $allTeachers = User::all();

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
        /*
        En editarSino:
            Crear options para seleccionar de todos los presidentes
        En verifyAdmin:
             mandar la lista completa de profesores para mandarla a editarSino
        */
        $presidente->presidente;
        DB::update('update sinodalias set user_id = ? where id = ?',[$presidente, $theUserSecretario->id]);
        return $request->id;
    }
    public function updateAprobacionProyecto()
    {
        return '';
    }
    public function updateAprobacionFinal()
    {
        return '';
    }

    // UTILIDADES ---------------
    public function sinodalCard($request)
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
}