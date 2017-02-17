<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\Solicitude;
use App\Models\Usuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstitucionController extends Controller
{

    use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('view-instituciones')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 1) {
            $board_user = 'b_admin';
        }

        $instituciones = Institucion::all();
        return view('visualizar_institucion', compact('instituciones', 'board_user'));
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
        if (Gate::denies('ingresar-instituciones')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 1) {
            $board_user = 'b_admin';
        }
        return view('ingresar_institucion', compact('board_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'codigoInstitucion' => ['required','unique:institucion'],
            'nombre' => ['required', 'max:45'],
            'direccion' => ['required', 'max: 45'],
            'telefono' => ['required', 'size:7'],
            'sitioWeb' => ['required', 'active_url'],
            'ciudad' => ['required', 'max:45']
        ]);

        $data = $request->all();

        Institucion::create([
            'codigoInstitucion' => $data['codigoInstitucion'],
            'nombre' => $data['nombre'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'sitioWeb' => $data['sitioWeb'],
            'ciudad' => $data['ciudad'],
        ]);

        return redirect()->to('instituciones');
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
        if (Gate::denies('modificar-instituciones')){
            abort(403);
        }

        $institucion = Institucion::find($id);

        if ($institucion->codigoInstitucion != $request->codigoInstitucion) {
            $validar_codigo = Validator::make($request->all(), [
                'codigoInstitucion' => ['required','unique:institucion'],
            ]);
            if ($validar_codigo->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'El NIT ingresado ya existe, no se realizó la modificación');
            }
        }
        if ($institucion->nombre != $request->nombre) {
            $validar_nombre = Validator::make($request->all(), [
                'nombre' => ['required','max:45'],
            ]);
            if ($validar_nombre->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'El nombre no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        if ($institucion->direccion != $request->direccion) {
            $validar_direccion = Validator::make($request->all(), [
                'direccion' => ['required','max:45'],
            ]);
            if ($validar_direccion->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'La dirección no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        if ($institucion->telefono != $request->telefono) {
            $validar_telefono = Validator::make($request->all(), [
                'telefono' => ['required','size:7'],
            ]);
            if ($validar_telefono->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'El telefono no es válido, no se realizó la modificación');
            }
        }
        if ($institucion->sitioWeb != $request->sitioWeb) {
            $validar_sitioWeb = Validator::make($request->all(), [
                'sitioWeb' => ['required', 'active_url'],
            ]);
            if ($validar_sitioWeb->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'El sitioWeb ingresado no es válido, no se realizó la modificación');
            }
        }
        if ($institucion->ciudad != $request->ciudad) {
            $validar_ciudad = Validator::make($request->all(), [
                'ciudad' => ['required', 'max:45'],
            ]);
            if ($validar_ciudad->fails()){
                return Redirect::to('instituciones')
                    ->with('modal_message_error', 'La ciudad no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        $data = $request->all();
        $institucion->fill($data);
        $institucion->save();
        return Redirect::to('instituciones')
            ->with('modal_message_success', 'Modificación realizada con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if (Gate::denies('eliminar-instituciones')){
            abort(403);
        }

        $no_eliminadas = array();
        $eliminadas = array();
        $instituciones = $request->eliminar;
        if (!empty($instituciones)) {
            foreach ($instituciones as $id) {
                $inst = Institucion::where('codigoInstitucion', '=', $id)->get()->first();
                if (Grupo::where('institucion_codigoInstitucion', '=', $inst->codigoInstitucion)->get()->isEmpty()) {
                    if (User::where('institucion_codigoInstitucion', '=', $inst->codigoInstitucion)->get()->isEmpty()) {
                        if (Solicitude::where('institucion_codigoInstitucion', '=', $inst->codigoInstitucion)->get()->isEmpty()) {
                            $eliminadas = array_add($eliminadas, $inst->codigoInstitucion, $inst->nombre);
                            $inst->delete();
                        }
                        else {
                            $no_eliminadas = array_add($no_eliminadas, $inst->codigoInstitucion, $inst->nombre);
                        }
                    }
                    else {
                        $no_eliminadas = array_add($no_eliminadas, $inst->codigoInstitucion, $inst->nombre);
                    }
                }
                else {
                    $no_eliminadas = array_add($no_eliminadas, $inst->codigoInstitucion, $inst->nombre);
                }
            }
            if (empty($no_eliminadas)) {
                return Redirect::to('instituciones')
                    ->with("modal_message_success", "Las instituciones han sido eliminadas de forma exitosa!");
            }
            else {
                return Redirect::to('instituciones')
                    ->with("modal_message_error", 'No se han eliminados las siguientes instituciones porque están asignadas a un grupo, usuario o solicitud: ' . implode(", ", $no_eliminadas));
            }
        }
        else {
            return Redirect::to('instituciones')
                ->with("modal_message_error", "No se ha seleccionado ninguna institución");
        }
    }
}
