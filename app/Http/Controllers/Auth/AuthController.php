<?php

namespace App\Http\Controllers\Auth;

use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\Solicitude;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        /*if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }*/

        if (Auth::validate($credentials)) {
            $user = Auth::getLastAttempted();
            if ($user->active) {
                Auth::login($user, $request->has('remember'));
                return redirect()->intended($this->redirectPath());
            } else {
                return redirect($this->loginPath()) // Change this to redirect elsewhere
                ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        'active' => 'Debes estar activo para iniciar sesión'
                    ]);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function getRegister()
    {
        $institucion = Institucion::lists('nombre', 'codigoInstitucion');
        /*$default = ['Seleccionar una' => ''];
        $array = (array)$institucion;
        array_unshift($array, $default);
        $institucion->exchangeArray($array);*/
        return view('auth.register', compact('institucion'));
    }


    public function getGrupos(Request $request, $codigoInstitucion)
    {
        if ($request->ajax()) {
            $grupos = Grupo::grupos($codigoInstitucion);
            return response()->json($grupos);
        }
    }

    public function postRegister(Request $request)
    {
        //print_r($request->all());
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (!User::where('id', '=', $request->id)->get()->isEmpty()) {
            $usuario = User::find($request->id);
            if ($usuario->active == 0) {
                if ($usuario->id != $request->id) {
                    $validar_id = Validator::make($request->all(), [
                        'id' => [ 'unique:users', 'unique:solicitudes' ],
                    ]);
                    if ($validar_id->fails()) {
                        return Redirect::to('/auth/register')->withErrors($validar_id);
                    }
                }
                if ($usuario->email != $request->email) {
                    $validar_email = Validator::make($request->all(), [
                        'email' => [ 'unique:users', 'unique:solicitudes' ],
                    ]);
                    if ($validar_email->fails()) {
                        return Redirect::to('/auth/register')->withErrors($validar_email);
                    }
                }
                $data = $request->all();
                $usuario->fill($data);
                $usuario->active = 1;
                $usuario->save();

                return Redirect::to('/auth/login')->with('modal_message_success', 'Usuario creado satisfactoriamente');
            }
            else {
                return Redirect::to('/auth/register')
                    ->with('modal_message_error', 'Este usuario ya existe');
            }
        }
        else {
            $data = $request->all();
            if ($request->grupo_codigoGrupo == "") {
                $data['grupo_codigoGrupo'] = null;
            }

            Auth::login($this->create($data));

            return Redirect::to($this->redirectPath())->with('modal_message_success', 'Se ha enviado la solicitud satisfactoriamente');
        }
    }

}
