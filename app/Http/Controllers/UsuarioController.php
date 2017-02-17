<?php

namespace App\Http\Controllers;

use App\Models\PsicologoHasGrupo;
use App\Models\Test;
use App\Models\TestHasPreguntastest;
use App\Models\UsersHasTest;
use Gate;
use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\Solicitude;
use App\Models\Tipousuario;
use App\Models\Usuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use phpDocumentor\Reflection\Types\Null_;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{

    use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('view-usuarios')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 0) {
            $usuarios = User::where('active', 1)->where('tipoUsuario_codigoTipoUsuario', '=', 1)->get();
            $institucion = Institucion::lists('nombre', 'codigoInstitucion');
            $board_user = 'b_root';
            return view('visualizar_usuario', compact('usuarios', 'institucion', 'board_user'));
        }
        elseif($tipo_usuario == 1) {
            $usuarios = User::where('active', 1)
                ->where('tipoUsuario_codigoTipoUsuario', '<>', 0)
                ->where('tipoUsuario_codigoTipoUsuario', '<>', 1)
                //->where('institucion_codigoInstitucion', '=', Auth::user()->institucion_codigoInstitucion)
                ->get();
            $institucion = Institucion::lists('nombre', 'codigoInstitucion');
            $board_user = 'b_admin';
            return view('visualizar_usuario', compact('usuarios', 'institucion', 'board_user'));
        }
        elseif($tipo_usuario == 2) {
            $usuarios = User::where('active', 1)
                ->where('tipoUsuario_codigoTipoUsuario', '=', 3)
                ->whereIn('grupo_codigoGrupo', PsicologoHasGrupo::where('users_id', Auth::user()->id)->select('grupo_codigoGrupo')->get())
                ->get();
            $institucion = Institucion::lists('nombre', 'codigoInstitucion');
            $tests = Test::all();
            $test_has_preguntas = TestHasPreguntastest::all('test_codigoTest', 'preguntasTest_codigoPregunta');
            $board_user = 'b_psicologo';
            return view('visualizar_usuario', compact('usuarios', 'institucion', 'board_user', 'tests', 'test_has_preguntas'));
        }

        #$usuarios = User::where('active', 1)->where('tipoUsuario_codigoTipoUsuario', '<>', 0)->get();
        /*$grupos = Grupo::lists('codigoGrupo');*/
        //$institucion = Institucion::lists('nombre', 'codigoInstitucion');
        //$grupos = Grupo::lists('codigoGrupo', 'codigoGrupo');
        //$tipo_usuario = Tipousuario::lists('nombre', 'codigoTipoUsuario');*/
        //return view('visualizar_usuario', compact('usuarios', 'institucion', 'board_user'));#, compact('grupos'), compact('instituciones'));
    }


    public function register()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('ingresar-usuarios')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 0) {
            $board_user = 'b_root';
        }
        elseif($tipo_usuario == 1) {
            $board_user = 'b_admin';
        }

        $institucion = Institucion::lists('nombre', 'codigoInstitucion');
        return view('ingresar_usuario', compact('institucion', 'board_user'));
    }

    public function getGrupos(Request $request, $institucion_codigoInstitucion)
    {
        if ($request->ajax()) {
            $grupos = Grupo::grupos($institucion_codigoInstitucion);
            return response()->json($grupos);
        }
    }

    public function getUsuario(Request $request, $id)
    {
        if ($request->ajax()) {
            $usuario = User::where('id', '=', $id)->get();
            return response()->json($usuario);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$usuario = User::find($request->id);

        if (!User::where('id', '=', $request->id)->get()->isEmpty()){
            $usuario = User::find($request->id);
            if ($usuario->active == 0) {
                if ($usuario->nombre != $request->name) {
                    $validar_name = Validator::make($request->all(), [
                        'name' => ['required','max:45'],
                    ]);
                    return Redirect::to('usuarios/ingresar')
                        ->withErrors($validar_name)
                        ->withInput();
                }
                if ($usuario->apellido != $request->apellido) {
                    $validar_apellido = Validator::make($request->all(), [
                        'apellido' => ['required','max:45'],
                    ]);
                    if ($validar_apellido->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_apellido)
                            ->withInput();
                    }
                }
                if ($usuario->email != $request->email) {
                    $validar_email = Validator::make($request->all(), [
                        'email' => ['required', 'email', 'max:255', 'unique:users', 'unique:solicitudes'],
                    ]);
                    if ($validar_email->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_email)
                            ->withInput();
                    }
                }
                if ($usuario->tipoDocumento != $request->tipoDocumento) {
                    $validar_tipoDocumento = Validator::make($request->all(), [
                        'tipoDocumento' => ['required'],
                    ]);
                    if ($validar_tipoDocumento->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_tipoDocumento)
                            ->withInput();
                    }
                }
                if ($usuario->fechaNacimiento != $request->fechaNacimiento) {
                    $validar_fechaNacimiento = Validator::make($request->all(), [
                        'fechaNacimiento' => ['required', 'before:now'],
                    ]);
                    if ($validar_fechaNacimiento->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_fechaNacimiento)
                            ->withInput();
                    }
                }
                $validar_contraseña = Validator::make($request->all(), [
                    'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                ]);
                if ($validar_contraseña->fails()){
                    return Redirect::to('/usuarios/ingresar')
                        ->withErrors($validar_contraseña)
                        ->withInput();
                }
                if ($usuario->genero != $request->genero) {
                    $validar_genero = Validator::make($request->all(), [
                        'genero' => ['required'],
                    ]);
                    if ($validar_genero->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_genero)
                            ->withInput();
                    }
                }
                if ($usuario->telefono != $request->telefono) {
                    $validar_telefono = Validator::make($request->all(), [
                        'telefono' => ['required','size:7'],
                    ]);
                    if ($validar_telefono->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_telefono)
                            ->withInput();
                    }
                }
                if ($usuario->tipoUsuario_codigoTipoUsuario != $request->all()) {
                    $validar_tipoUsuario_codigoTipoUsuario = Validator::make($request->all(), [
                        'tipoUsuario_codigoTipoUsuario' => ['required'],
                    ]);
                    if ($validar_tipoUsuario_codigoTipoUsuario->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_tipoUsuario_codigoTipoUsuario)
                            ->withInput();
                    }
                }
                if ($usuario->institucion_codigoInstitucion != $request->all()) {
                    $validar_institucion_codigoInstitucion = Validator::make($request->all(), [
                        'institucion_codigoInstitucion' => ['required_if:tipoUsuario_codigoTipoUsuario,3', 'required_if:tipoUsuario_codigoTipoUsuario,2'],
                    ]);
                    if ($validar_institucion_codigoInstitucion->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_institucion_codigoInstitucion)
                            ->withInput();
                    }
                }
                if ($usuario->grupo_codigoGrupo != $request->all()) {
                    $validar_grupo_codigoGrupo = Validator::make($request->all(), [
                        'grupo_codigoGrupo' => ['required_if:tipoUsuario_codigoTipoUsuario,3'],
                    ]);
                    if ($validar_grupo_codigoGrupo->fails()){
                        return Redirect::to('/usuarios/ingresar')
                            ->withErrors($validar_grupo_codigoGrupo)
                            ->withInput();
                    }
                }
                $data = $request->all();
                $data['password'] = bcrypt($request->password);
                if ($request->grupo_codigoGrupo == "") {
                    $data['grupo_codigoGrupo'] = null;
                }
                if ($request->institucion_codigoInstitucion == "") {
                    $data['institucion_codigoInstitucion'] = null;
                }
                $usuario->fill($data);
                $usuario->active=1;
                $usuario->save();
                return Redirect::to('usuarios')
                    ->with('modal_message_success', 'Usuario creado satisfactoriamente');
            }
            else {
                $this->validate($request, [
                    'id' => 'required|min:10|max:11|unique:users|unique:solicitudes',
                    'name' => 'required|max:45',
                    'apellido' => 'required|max:45',
                    'email' => 'required|email|max:255|unique:users|unique:solicitudes',
                    'tipoDocumento' => 'required',
                    'fechaNacimiento' => 'required|before:now',
                    'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                    'genero' => 'required',
                    'telefono' => 'required|size:7',
                    'tipoUsuario_codigoTipoUsuario' => 'required',
                    'grupo_codigoGrupo' => 'required_if:tipoUsuario_codigoTipoUsuario,3',
                    'institucion_codigoInstitucion' => 'required_if:tipoUsuario_codigoTipoUsuario,3|required_if:tipoUsuario_codigoTipoUsuario,2',
                ]);
            }
        }
        else {
            $this->validate($request, [
                'id' => 'required|min:10|max:11|unique:users|unique:solicitudes',
                'name' => 'required|max:45',
                'apellido' => 'required|max:45',
                'email' => 'required|email|max:255|unique:users|unique:solicitudes',
                'tipoDocumento' => 'required',
                'fechaNacimiento' => 'required|before:now',
                'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'genero' => 'required',
                'telefono' => 'required|size:7',
                'tipoUsuario_codigoTipoUsuario' => 'required',
                'grupo_codigoGrupo' => 'required_if:tipoUsuario_codigoTipoUsuario,3',
                'institucion_codigoInstitucion' => 'required_if:tipoUsuario_codigoTipoUsuario,3|required_if:tipoUsuario_codigoTipoUsuario,2',
            ]);

            $data = $request->all();
            if ($request->grupo_codigoGrupo == "") {
                $data['grupo_codigoGrupo'] = null;
            }
            if ($request->institucion_codigoInstitucion == "") {
                $data['institucion_codigoInstitucion'] = null;
            }

            if ($data['tipoUsuario_codigoTipoUsuario'] == 1 && Auth::user()->tipoUsuario_codigoTipoUsuario == 1){
                Solicitude::create([
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
                return Redirect::to('usuarios')
                    ->with('modal_message_success', 'Se ha enviado la solicitud satisfactoriamente');
            }
            else{
                User::create([
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
                return Redirect::to('usuarios')
                    ->with('modal_message_success', 'Usuario creado satisfactoriamente');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        if (Gate::denies('modificar-usuarios')){
            abort(403);
        }

        $usuario = User::find($id);

        if ($usuario->id != $request->id) {
            $validar_id = Validator::make($request->all(), [
                'id' => ['required', 'min:10', 'max:11', 'unique:users', 'unique:solicitudes'],
            ]);
            if ($validar_id->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'El id ingresado ya existe o no es válido, no se realizó la modificación');
            }
        }
        if ($usuario->name != $request->name) {
            $validar_name = Validator::make($request->all(), [
                'name' => [ 'required', 'max:45' ],
            ]);
            if ($validar_name->fails()) {
                return Redirect::to('usuarios')->with('modal_message_error',
                        'El nombre no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        if ($usuario->apellido != $request->apellido) {
            $validar_apellido = Validator::make($request->all(), [
                'apellido' => ['required','max:45'],
            ]);
            if ($validar_apellido->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'El apellido no puede contener más de 255 caracteres, no se realizó la modificación');
            }
        }
        if ($usuario->email != $request->email) {
            $validar_email = Validator::make($request->all(), [
                'email' => ['required', 'email', 'max:255', 'unique:users', 'unique:solicitudes'],
            ]);
            if ($validar_email->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'El email no es válido, no se realizó la modificación');
            }
        }
        if ($usuario->tipoDocumento != $request->tipoDocumento) {
            $validar_tipoDocumento = Validator::make($request->all(), [
                'tipoDocumento' => ['required'],
            ]);
            if ($validar_tipoDocumento->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'Debe seleccionar el tipo de documento, no se realizó la modificación');
            }
        }
        if ($usuario->fechaNacimiento != $request->fechaNacimiento) {
            $validar_fechaNacimiento = Validator::make($request->all(), [
                'fechaNacimiento' => ['required', 'before:now'],
            ]);
            if ($validar_fechaNacimiento->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'La fecha de nacimiento seleccionada no es válida, no se realizó la modificación');
            }
        }
        if ($usuario->genero != $request->genero) {
            $validar_genero = Validator::make($request->all(), [
                'genero' => ['required'],
            ]);
            if ($validar_genero->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'Debe seleccionar un genero, no se realizó la modificación');
            }
        }
        if ($usuario->telefono != $request->telefono) {
            $validar_telefono = Validator::make($request->all(), [
                'telefono' => ['required','size:7'],
            ]);
            if ($validar_telefono->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'El telefono no es válido, no se realizó la modificación');
            }
        }
        if ($usuario->institucion_codigoInstitucion != $request->institucion_codigoInstitucion) {
            $validar_institucion_codigoInstitucion = Validator::make($request->all(), [
                'institucion_codigoInstitucion' => ['required_if:tipoUsuario_codigoTipoUsuario,3', 'required_if:tipoUsuario_codigoTipoUsuario,2'],
            ]);
            if ($validar_institucion_codigoInstitucion->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'La institucion seleccionada no es válida, no se realizó la modificación');
            }
        }
        if ($usuario->grupo_codigoGrupo != $request->grupo_codigoGrupo) {
            $validar_grupo_codigoGrupo = Validator::make($request->all(), [
                'grupo_codigoGrupo' => ['required_if:tipoUsuario_codigoTipoUsuario,3'],
            ]);
            if ($validar_grupo_codigoGrupo->fails()){
                return Redirect::to('usuarios')
                    ->with('modal_message_error', 'El grupo seleccionado no es válido, no se realizó la modificación');
            }
        }

        $data = $request->all();

        if ($request->grupo_codigoGrupo == "") {
            $data['grupo_codigoGrupo'] = null;
        }
        if ($request->institucion_codigoInstitucion == "") {
            $data['institucion_codigoInstitucion'] = null;
        }

        $usuario->fill($data);
        $usuario->save();
        return Redirect::to('usuarios')
            ->with('modal_message_success', 'Modificación realizada con éxito');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePerfil(Request $request, $id)
    {
        $usuario = User::find($id);

        if ($usuario->id != $request->id) {
            $validar_id = Validator::make($request->all(), [
                'id' => ['required', 'min:10', 'max:11', 'unique:users', 'unique:solicitudes'],
            ]);
            if ($validar_id->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'El id ingresado ya existe, no se realizó la modificación');
            }
        }
        if ($usuario->nombre != $request->nombre) {
            $validar_name = Validator::make($request->all(), [
                'nombre' => [ 'required', 'max:45' ],
            ]);
            if ($validar_name->fails()) {
                return Redirect::to('home')->with('modal_message_error',
                        'El nombre no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        if ($usuario->apellido != $request->apellido) {
            $validar_apellido = Validator::make($request->all(), [
                'apellido' => ['required','max:45'],
            ]);
            if ($validar_apellido->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'El apellido no puede contener más de 255 caracteres, no se realizó la modificación');
            }
        }
        if ($usuario->email != $request->email) {
            $validar_email = Validator::make($request->all(), [
                'email' => ['required', 'email', 'max:255', 'unique:users', 'unique:solicitudes'],
            ]);
            if ($validar_email->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'El email no es válido, no se realizó la modificación');
            }
        }
        if ($usuario->password != $request->password) {
            $validar_password = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ]);
            if ($validar_password->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'La contraseña no es válida, no se realizó la modificación');
            }
            $password = bcrypt($request->password);
        }
        else {
            $password = $request->password;
        }
        if ($usuario->tipoDocumento != $request->tipoDocumento) {
            $validar_tipoDocumento = Validator::make($request->all(), [
                'tipoDocumento' => ['required'],
            ]);
            if ($validar_tipoDocumento->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'Debe seleccionar el tipo de documento, no se realizó la modificación');
            }
        }
        if ($usuario->fechaNacimiento != $request->fechaNacimiento) {
            $validar_fechaNacimiento = Validator::make($request->all(), [
                'fechaNacimiento' => ['required', 'before:now'],
            ]);
            if ($validar_fechaNacimiento->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'La fecha de nacimiento seleccionada no es válida, no se realizó la modificación');
            }
        }
        if ($usuario->genero != $request->genero) {
            $validar_genero = Validator::make($request->all(), [
                'genero' => ['required'],
            ]);
            if ($validar_genero->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'Debe seleccionar un genero, no se realizó la modificación');
            }
        }
        if ($usuario->telefono != $request->telefono) {
            $validar_telefono = Validator::make($request->all(), [
                'telefono' => ['required','size:7'],
            ]);
            if ($validar_telefono->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'El telefono no es válido, no se realizó la modificación');
            }
        }
        if ($usuario->institucion_codigoInstitucion != $request->all()) {
            $validar_institucion_codigoInstitucion = Validator::make($request->all(), [
                'institucion_codigoInstitucion' => ['required_if:tipoUsuario_codigoTipoUsuario,3', 'exists:institucion,codigoInstitucion'],
            ]);
            if ($validar_institucion_codigoInstitucion->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'La institucion seleccionada no es válida, no se realizó la modificación');
            }
        }
        if ($usuario->grupo_codigoGrupo != $request->all()) {
            $validar_grupo_codigoGrupo = Validator::make($request->all(), [
                'grupo_codigoGrupo' => ['required_if:tipoUsuario_codigoTipoUsuario,3'],
            ]);
            if ($validar_grupo_codigoGrupo->fails()){
                return Redirect::to('home')
                    ->with('modal_message_error', 'El grupo seleccionado no es válido, no se realizó la modificación');
            }
        }
        $data = $request->all();
        $data['password'] = $password;
        $usuario->fill($data);
        /*if ($usuario->password != $data['password']) {
            $usuario->password = bcrypt($data['password']);
        }*/
        $usuario->save();
        return Redirect::to('home')
            ->with('modal_message_success', 'Modificación realizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Gate::denies('eliminar-usuarios')){
            abort(403);
        }

        $ids = $request->eliminar;
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $user = User::find($id);
                $user->active = 0;
                $user->save();
            }
            //Flash::success('Los usuarios han sido borrado de forma exitosa!');
            return Redirect::to('usuarios')
                ->with('modal_message_success', "Los usuarios han sido borrado de forma exitosa!'");
        }
        else {
            //Flash::error('No se ha seleccionado ningun usuario');
            return Redirect::to('usuarios')
                ->with('modal_message_error', "No se ha seleccionado ningun usuario");
        }
    }

    public function asignarTest(Request $request)
    {
        if (Gate::denies('asignar-test-usuarios')){
            abort(403);
        }

        $usuarios = $request->asignar_usuarios;
        $tests = $request->asignar_test;

        if (!empty($usuarios)) {
            if (!empty($tests)) {
                foreach ($usuarios as $usuario) {
                    foreach ($tests as $test) {
                        $user_has_test = Test::find($test);
                        if (UsersHasTest::where('users_id', '=', $usuario)->where('test_codigoTest', '=', $user_has_test->codigoTest)->get()->isEmpty()) {
                            UsersHasTest::create([
                                'users_id'                            => $usuario,
                                'users_tipoUsuario_codigoTipoUsuario' => 3,
                                'test_codigoTest'                     => $user_has_test->codigoTest,
                                'test_tipoTest_codigoTipoTest'        => $user_has_test->tipoTest_codigoTipoTest,
                                'estadoTest'                          => 0,
                                'resultado' => null,
                                'diagnostico' => null,
                            ]);
                        }
                    }
                }
                return back()
                    ->with('modal_message_success', "Se han asignado los test satisfactoriamente");
            }
            else {
                return back()
                    ->with('modal_message_error', "No se ha seleccionado ningun test");
            }
        }
        else {
            return back()
                ->with('modal_message_error', "No se ha seleccionado ningun usuario");
        }
    }
}
