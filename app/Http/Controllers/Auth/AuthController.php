<?php

namespace App\Http\Controllers\Auth;

use App\Models\Solicitude;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'id' => 'required|min:10|max:11|unique:solicitudes',//|unique:users|unique:solicitudes',
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:solicitudes',//|unique:users|unique:solicitudes',
            'tipoDocumento' => 'required',
            'fechaNacimiento' => 'required|before:now',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'genero' => 'required',
            'telefono' => 'required|size:7',
            'tipoUsuario_codigoTipoUsuario' => 'required',
            'grupo_codigoGrupo' => 'required_if:tipoUsuario_codigoTipoUsuario,3',
            'institucion_codigoInstitucion' => 'required_if:tipoUsuario_codigoTipoUsuario,3'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //print_r($data);
        return Solicitude::create([
            'id' => $data['id'],
            'nombre' => $data['name'],
            'apellido' => $data['apellido'],
            'email'=> $data['email'],
            'tipoDocumento' => $data['tipoDocumento'],
            'fechaNacimiento' => $data['fechaNacimiento'],
            'active' => 1,
            'password'=> bcrypt($data['password']),
            'genero' => $data['genero'],
            'telefono' => $data['telefono'],
            'grupo_codigoGrupo' => $data['grupo_codigoGrupo'],
            'institucion_codigoInstitucion' => $data['institucion_codigoInstitucion'],
            'tipoUsuario_codigoTipoUsuario' => $data['tipoUsuario_codigoTipoUsuario'],
        ]);
    }
}
