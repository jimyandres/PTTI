<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\PsicologoHasGrupo;
use App\Models\Solicitude;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Gate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GrupoController extends Controller
{

    use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('view-grupos')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 0) {
            $board_user = 'b_root';
        }
        elseif($tipo_usuario == 1) {
            $board_user = 'b_admin';
            $grupos = Grupo::all();
        }
        elseif($tipo_usuario == 2) {
            $board_user = 'b_psicologo';
            $grupos = Grupo::whereIn('codigoGrupo', PsicologoHasGrupo::where('users_id', Auth::user()->id)->select('grupo_codigoGrupo')->get())->get();
        }

        $psicologos = PsicologoHasGrupo::lists('users_id', 'grupo_codigoGrupo');
        $psicologos_all = User::where('tipoUsuario_codigoTipoUsuario', '=', 2)
            ->where('active', '=', 1)
            ->select('nombre','apellido', 'id')->lists('nombre', 'id');
        //$psicologos = PsicologoHasGrupo::join('users','users.id', '=', 'psicologo_has_grupo.users_id')->select('users.id', 'users.nombre', 'users.apellido', 'psicologo_has_grupo.grupo_codigoGrupo')->get();
        $institucion = Institucion::lists('nombre', 'codigoInstitucion');
        //$usuarios = User::where('tipoUsuario_codigoTipoUsuario', '=', 2)->get()->lists('nombre', 'id');
        //$usuarios = User::join('')
        //$usuarios = User::where('tipoUsuario_codigoTipoUsuario', '=', 2)->get();
        return view('visualizar_grupo', compact('grupos', 'institucion', 'board_user', 'psicologos', 'psicologos_all'));//, 'usuarios'));
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

        if (Gate::denies('ingresar-grupos')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 1) {
            $board_user = 'b_admin';
        }

        $institucion = Institucion::lists('nombre', 'codigoInstitucion');
        return view('ingresar_grupo', compact('institucion', 'board_user'));
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
            'codigoGrupo' => ['required','unique:grupo'],
            'clasificacion' => ['required', 'max:45'],
            'jornada' => ['required', 'max: 45'],
            'grado' => ['required', 'max:11', 'min:1'],
            'institucion_codigoInstitucion' => ['required', 'exists:institucion,codigoInstitucion']
        ]);

        $data = $request->all();

        Grupo::create([
            'codigoGrupo' => $data['codigoGrupo'],
            'clasificacion' => $data['clasificacion'],
            'jornada' => $data['jornada'],
            'grado' => $data['grado'],
            'institucion_codigoInstitucion' => $data['institucion_codigoInstitucion'],
        ]);

        return redirect()->to('grupos');
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

        if (Gate::denies('modificar-grupos')){
            abort(403);
        }

        $grupo = Grupo::find($id);

        if ($grupo->codigoGrupo != $request->codigoGrupo) {
            $validar_codigo = Validator::make($request->all(), [
                'codigoGrupo' => ['required','unique:grupo'],
            ]);
            if ($validar_codigo->fails()){
                return Redirect::to('grupos')
                    ->with('modal_message_error', 'El codigo ingresado ya existe, no se realizó la modificación');
            }
        }
        if ($grupo->clasificacion != $request->clasificacion) {
            $validar_clasificacion = Validator::make($request->all(), [
                'clasificacion' => ['required','max:45'],
            ]);
            if ($validar_clasificacion->fails()){
                return Redirect::to('grupos')
                    ->with('modal_message_error', 'La clasificacion no puede contener más de 45 caracteres, no se realizó la modificación');
            }
        }
        if ($grupo->jornada != $request->jornada) {
            $validar_jornada = Validator::make($request->all(), [
                'jornada' => ['required','max:45'],
            ]);
            if ($validar_jornada->fails()){
                return Redirect::to('grupos')
                    ->with('modal_message_error', 'La jornada no es válida, no se realizó la modificación');
            }
        }
        if ($grupo->grado != $request->grado) {
            $validar_grado = Validator::make($request->all(), [
                'grado' => ['required', 'max:11', 'min:1'],
            ]);
            if ($validar_grado->fails()){
                return Redirect::to('grupos')
                    ->with('modal_message_error', 'El grado no es válido, no se realizó la modificación');
            }
        }
        if ($grupo->institucion_codigoInstitucion != $request->institucion_codigoInstitucion) {
            $validar_institucion_codigoInstitucion = Validator::make($request->all(), [
                'institucion_codigoInstitucion' => ['required', 'exists:institucion,codigoInstitucion'],
            ]);
            if ($validar_institucion_codigoInstitucion->fails()){
                return Redirect::to('grupos')
                    ->with('modal_message_error', 'La institucion seleccionada no es válida, no se realizó la modificación');
            }
        }

        $data = $request->except('psicologo', 'psicologo_old');

        $grupo_psicologo = PsicologoHasGrupo::where('users_id', '=', $request->psicologo_old)
            ->where('grupo_codigoGrupo', '=', $grupo->codigoGrupo)
            ->get()->first();

        if ($request->cambiar_psicologo == 'si') {
            if (empty($grupo_psicologo)) {
                echo 'Psicologo anterior: '.$request->psicologo_old.'      '.$request->psicologo;
                $validar_psicologo = Validator::make($request->all(), [
                    'psicologo' => [
                        'exists:users,id,tipoUsuario_codigoTipoUsuario,2',
                        'exists:users,id,institucion_codigoInstitucion,'.$grupo->institucion_codigoInstitucion
                    ],
                ]);
                if ($validar_psicologo->fails()) {
                    return Redirect::to('grupos')->with('modal_message_error',
                            'El psicologo seleccionado no es válido, no se realizó la modificación');
                }
                $psicologo = $request->psicologo;
                PsicologoHasGrupo::create([
                    'users_id'                            => $psicologo,
                    'users_tipoUsuario_codigoTipoUsuario' => 2,
                    'grupo_codigoGrupo'                   => $grupo->codigoGrupo,
                ]);
            } else {

                if ($grupo_psicologo->users_id != $request->psicologo) {
                    if ($request->psicologo != "") {
                        echo 'Psicologo anterior: '.$request->psicologo_old.'      '.$request->psicologo;
                        $validar_psicologo = Validator::make($request->all(), [
                            'psicologo' => [
                                'exists:users,id,tipoUsuario_codigoTipoUsuario,2',
                                'exists:users,id,institucion_codigoInstitucion,'.$grupo->institucion_codigoInstitucion
                            ],
                        ]);
                        if ($validar_psicologo->fails()) {
                            return Redirect::to('grupos')->with('modal_message_error',
                                'El psicologo seleccionado no es válido, no se realizó la modificación');
                        }
                        $psicologo = $request->psicologo;
                        echo $psicologo;
                        $grupo_psicologo->fill([
                            'users_id'                            => $psicologo,
                            'users_tipoUsuario_codigoTipoUsuario' => 2,
                            'grupo_codigoGrupo'                   => $grupo->codigoGrupo
                        ]);
                        $grupo_psicologo->save();
                    } else {
                        $grupo_psicologo->delete();
                    }
                } else {
                    $psicologo = $grupo_psicologo->users_id;
                    $grupo_psicologo->fill([
                        'users_id'                            => $psicologo,
                        'users_tipoUsuario_codigoTipoUsuario' => 2,
                        'grupo_codigoGrupo'                   => $grupo->codigoGrupo
                    ]);
                    $grupo_psicologo->save();
                }
            }
        }

        /*if ($request->psicologo != null) {
            $grupo_psicologo = PsicologoHasGrupo::where('users_id', '=', $request->psicologo)
                                                ->where('grupo_codigoGrupo', '=', $grupo->codigoGrupo)
                                                ->get()->first();//->update(array('grupo_codigoGrupo' => $request->codigoGrupo));
            /*echo $request->psicologo;
            echo $request->codigoGrupo;
            echo $grupo_psicologo;
            $grupo_psicologo->fill(array('users_id' => $request->psicologo, 'users_tipoUsuario_codigoTipoUsuario' => 2, 'grupo_codigoGrupo' => $request->codigoGrupo));
            $grupo_psicologo->save();
        }*/
        //$grupo_psicologo = PsicologoHasGrupo::where('users')

        $grupo->fill($data);
        $grupo->save();
        return Redirect::to('grupos')
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
        if (Gate::denies('eliminar-grupos')){
            abort(403);
        }

        $no_eliminadas = array();
        $eliminadas = array();
        $grupos = $request->eliminar;
        if (!empty($grupos)) {
            foreach ($grupos as $id) {
                $grupo = Grupo::where('codigoGrupo', '=', $id)->get()->first();
                if (User::where('grupo_codigoGrupo', '=', $grupo->codigoGrupo)->get()->isEmpty()) {
                    if (Solicitude::where('grupo_codigoGrupo', '=', $grupo->codigoGrupo)->get()->isEmpty()) {
                        $eliminadas = array_add($eliminadas, $grupo->codigoGrupo, $grupo->codigoGrupo);
                        $grupo->delete();
                    } else {
                        $no_eliminadas = array_add($no_eliminadas, $grupo->codigoGrupo, $grupo->codigoGrupo);
                    }
                } else {
                    $no_eliminadas = array_add($no_eliminadas, $grupo->codigoGrupo, $grupo->codigoGrupo);
                }
            }
            if (empty($no_eliminadas)) {
                return Redirect::to('grupos')
                    ->with("modal_message_success", "Los grupos han sido eliminados de forma exitosa!");
            }
            else {
                return Redirect::to('grupos')
                    ->with("modal_message_error", 'No se han eliminados los siguientes grupos porque están asignadas a un usuario o solicitud: ' . implode(", ", $no_eliminadas));
            }
        }
        else {
            return Redirect::to('grupos')
                ->with("modal_message_error", "No se ha seleccionado ningun grupo");
        }
    }
}
