<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'telefono' => 'digits:10',
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
        $num_phone = 0;
        if (isset($data['telefono'])) {
            $num_phone = $data['telefono']; 
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cargo' => $data['cargo'],
            'disponibilidad' => 1,
            'num_asignaciones' => 0,
            'anteproyecto_cuenta' => 0,
            'proyecto_cuenta' => 0,
            'num_control' => $data['num_control'],
            'telefono' => $num_phone, 
            'password' => Hash::make($data['password']),
        ]);
    }
}
