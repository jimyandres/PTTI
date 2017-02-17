<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Solicitude;
use App\User;
use Illuminate\Http\Request;
use Gate;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-solicitudes')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 0) {
            $solicitudes = Solicitude::where('tipoUsuario_codigoTipoUsuario', '=', 1)
                ->where('active', '=', 1)
                ->get();
            $board_user = 'b_root';
        }
        elseif($tipo_usuario == 1) {
            $solicitudes = Solicitude::where('tipoUsuario_codigoTipoUsuario', '<>', 1)
                ->where('active', '=', 1)
                ->get();
            $board_user = 'b_admin';
        }

        $institucion = Institucion::lists('nombre', 'codigoInstitucion');

        return view('visualizar_solicitud', compact('solicitudes', 'institucion', 'board_user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('aceptar-solicitudes')){
            abort(403);
        }

        /*$validar_solicitud = Validator::make($request->all(), [
            'id' => 'required|digits_between:10,11|unique:users|unique:solicitudes',
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
            'institucion_codigoInstitucion' => 'required_if:tipoUsuario_codigoTipoUsuario,3|exists:institucion,codigoInstitucion',
        ]);

        if ($validar_solicitud->fails()) {
            return Redirect::to('solicitudes')
                ->with('modal_message_error')
                ->withErrors($validar_solicitud);
        }*/

        $solicitud = $request->all();

        User::create([
            'id' => $solicitud['id'],
            'nombre' => $solicitud['name'],
            'apellido' => $solicitud['apellido'],
            'email'=> $solicitud['email'],
            'tipoDocumento' => $solicitud['tipoDocumento'],
            'fechaNacimiento' => $solicitud['fechaNacimiento'],
            'active' => 1,
            'password'=> $solicitud['password'],
            'genero' => $solicitud['genero'],
            'telefono' => $solicitud['telefono'],
            'grupo_codigoGrupo' => $solicitud['grupo_codigoGrupo'],
            'institucion_codigoInstitucion' => $solicitud['institucion_codigoInstitucion'],
            'tipoUsuario_codigoTipoUsuario' => $solicitud['tipoUsuario_codigoTipoUsuario'],
        ]);

        $solicitud = Solicitude::find($request->id);
        $solicitud->delete();

        return Redirect::to('solicitudes')
            ->with('modal_message_success', 'Solicitud aceptada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (Gate::denies('rechazar-solicitudes')){
            abort(403);
        }

        $solicitud = Solicitude::find($request->id);
        $solicitud->delete();

        return Redirect::to('solicitudes')
            ->with('modal_message_error', 'Solicitud rechazada');
    }
}
