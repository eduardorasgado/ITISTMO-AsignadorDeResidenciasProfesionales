<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cargo' => 'required|string',
            'num_control' => 'required|string|max:80|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // para acceder al cargo
        // ver en register.blade
        // boss = asignador
        //admon = Personal administrativo
        // profesor => Profesorado
        $cargoNum;
        $cargos = ['boss' => 0,
                'admon' =>1,
                'profesor' =>2];
        // buscando la conversion del cargo
        foreach ($cargos as $key => $value) {
            if($key == $data['cargo']){
                $cargoNum = $value;
            }
        }
        $num_phone = 0;
        // en caso de no haber telefono
        if (isset($data['telefono'])) {
            $num_phone = $data['telefono']; 
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cargo' => $cargoNum,
            'disponibilidad' => 0,
            'num_asignaciones' => 0,
            'anteproyecto_cuenta' => 0,
            'proyecto_cuenta' => 0,
            'num_control' => $data['num_control'],
            'telefono' => $num_phone, 
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function showRegistrationForm() {
        // si aun no existe ningun usuario registrado
        if(User::all()->isEmpty()){
            // se puede abrir el registro
            return view('auth.register');
        }
        // si el usuario esta logueado
        else if(Auth::user() != null){
            // y si el usuario logueado es asignador
            if(Auth::user()->cargo == 0){
                return view('auth.register');
            }
        }
        // ninguno de los casos mencionados
        return view('/welcome');
    }

    public function register(Request $request)
    {
        // esta funcion permite redireccionar 
        // despues del registro en vez de loggear
        $validator = $this->validator($request->all());

        // en caso de error
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );  
        }   

        $this->create($request->all());
        if (Auth::user() != null) {
            // si el usuario esta logueado
            // regresar a dashboard
            return redirect('/teachersPanel');
        }
        // si el registro se hizo desde fuera
        // sin que el asignador este logueado
        return redirect($this->redirectPath());
    } 
}
