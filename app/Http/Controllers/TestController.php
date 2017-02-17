<?php

namespace App\Http\Controllers;

use App\Models\Preguntastest;
use App\Models\Respuesta;
use App\Models\Test;
use App\Models\TestHasPreguntastest;
use App\Models\UsersHasTest;
use Illuminate\Http\Request;
use Gate;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('view-test')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 1) {
            $tests = Test::all();
            $preguntastest = Preguntastest::lists('enunciado', 'codigoPregunta');
            $test_has_preguntas = TestHasPreguntastest::all('test_codigoTest', 'preguntasTest_codigoPregunta');
            $board_user = 'b_admin';
            return view('visualizar_test', compact('tests', 'board_user', 'preguntastest', 'test_has_preguntas'));#, compact('grupos'), compact('instituciones'));
        }
        elseif ($tipo_usuario == 2) {
            $users_has_tests = UsersHasTest::leftJoin('users', 'users_has_test.users_id', '=', 'users.id')
                ->leftJoin('test', 'users_has_test.test_codigoTest', '=', 'test.codigoTest')
                ->select('test.descripcion', 'users.nombre', 'users.apellido', 'users.grupo_codigoGrupo', 'users_has_test.resultado', 'users_has_test.diagnostico', 'test.codigoTest', 'users.id', 'users_has_test.estadoTest')
                ->get();
            $board_user = 'b_psicologo';
            return view('visualizar_test', compact('board_user', 'users_has_tests'));
        }
        elseif ($tipo_usuario == 3) {
            if (UsersHasTest::where('users_id', '=',  Auth::user()->id)->where('estadoTest', '=', 0)->get()->isEmpty()) {
                $user_has_tests = UsersHasTest::leftJoin('users', 'users_has_test.users_id', '=', 'users.id')
                    ->leftJoin('test', 'users_has_test.test_codigoTest', '=', 'test.codigoTest')
                    ->select('test.descripcion', 'users_has_test.resultado', 'users_has_test.diagnostico', 'test.codigoTest', 'users.id', 'users_has_test.estadoTest')
                    ->where('users_has_test.users_id', '=', Auth::user()->id)
                    ->get();
                $board_user = 'b_estudiante';
                return view('visualizar_test', compact('board_user', 'user_has_tests'));
            }
            else {
                $test = UsersHasTest::where('users_id', '=',  Auth::user()->id)->where('estadoTest', '=', 0)->get()->first();
                return Redirect::to('test/realizar/' . $test->test_codigoTest)->with('modal_message_error', 'Tienes test sin finalizar, por favor solucionelo');
            }
        }
    }

    public function getPregunta(Request $request, $codigoPregunta)
    {
        if ($request->ajax()) {
            $pregunta = Preguntastest::where('codigoPregunta', '=', $codigoPregunta)->get();
            return response()->json($pregunta);
        }
    }

    public function getPreguntasTest(Request $request, $codigoTest)
    {
        $test_has_preguntas = TestHasPreguntastest::where('test_codigoTest', '=', $codigoTest)->select('preguntasTest_codigoPregunta')->get();

        return response()->json($test_has_preguntas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Gate::denies('crear-test')){
            abort(403);
        }

        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        if($tipo_usuario == 1) {
            $board_user = 'b_admin';
        }

        $preguntastest = Preguntastest::lists('enunciado', 'codigoPregunta');
        return view('crear_test', compact('board_user', 'preguntastest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validar_descripcion = Validator::make($request->all(), [
            'descripcion' => ['required', 'max:300', 'unique:test'],
        ]);
        if ($validar_descripcion->fails()) {
            return Redirect::to('test/crear')
                ->with($validar_descripcion)
                ->withInput();
        }
        else {
            $opciones = [];
            $flag_crear_pregunta = [];
            $cant_preguntas = count($request->enunciado);
            for ($i = 0; $i < $cant_preguntas; $i++) {
                $opciones[$i] = $request->opciones_a[$i] . '#' . $request->opciones_b[$i] . '#' . $request->opciones_c[$i] . '#' . $request->opciones_d[$i];
                if (Preguntastest::where('codigoPregunta', '=', $request->pregunta_existente[$i])->get()->isEmpty()){
                    $validar_preguntas = Validator::make(['enunciado' => $request->enunciado[$i], 'opciones' => $opciones[$i]], [
                        'enunciado' => ['required', 'max:45'],
                        'opciones' => ['required', 'max:200'],
                    ]);
                    if ($validar_preguntas->fails()) {
                        return Redirect::to('test/crear')
                            ->with($validar_preguntas)
                            ->withInput();
                    }
                    else {
                        $flag_crear_pregunta[$i] = true;
                    }
                }
                else {
                    $pregunta_seleccionada = Preguntastest::find($request->pregunta_existente[$i]);
                    //echo Preguntastest::find($request->pregunta_existente[$i]);
                    //echo $request->pregunta_existente[$i];
                    if ($pregunta_seleccionada->enunciado != $request->enunciado[$i] || $pregunta_seleccionada->opcionesRespuesta != $opciones[$i]) {
                        $validar_preguntas = Validator::make(['enunciado' => $request->enunciado[$i], 'opciones' => $opciones[$i]], [
                            'enunciado' => ['required', 'max:45'],
                            'opciones' => ['required', 'max:200'],
                        ]);
                        if ($validar_preguntas->fails()) {
                            return Redirect::to('test/crear')
                                ->with($validar_preguntas)
                                ->withInput();
                        }
                        else {
                            $flag_crear_pregunta[$i] = true;
                        }
                    }
                    else {
                        $flag_crear_pregunta[$i] = false;
                    }
                }
            }
            $data = $request->all();
            $test = Test::create([
                'descripcion' => $data['descripcion'],
                'tipoTest_codigoTipoTest' => $request->tipotest,
                'informe_codigoInforme' => null,
            ]);
            for ($i = 0; $i < $cant_preguntas; $i++) {
                if ($flag_crear_pregunta[$i]) {
                    $pregunta = Preguntastest::create([
                        'enunciado' => $request->enunciado[$i],
                        'opcionesRespuesta' => $opciones[$i],
                    ]);
                }
                else {
                    $pregunta =  Preguntastest::find($request->pregunta_existente[$i]);
                }
                if(TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->where('preguntasTest_codigoPregunta', '=', $pregunta->codigoPregunta)->get()->isEmpty()) {
                    TestHasPreguntastest::create([
                        'test_codigoTest'              => $test->codigoTest,
                        'test_tipoTest_codigoTipoTest' => $test->tipoTest_codigoTipoTest,
                        'preguntasTest_codigoPregunta' => $pregunta->codigoPregunta,
                    ]);
                }
            }
            return Redirect::to('test')
                ->with('modal_message_success', 'Test creado satisfactoriamente');
            /*echo "Descripcion: " . $request->descripcion . "\n";
            $opciones = [];
            for ($i = 0; $i < count($request->enunciado); $i++) {
                echo "Pregunta".$i."\n";
                echo "Enunciado:" . $request->enunciado[$i] . "\n";
                $opciones[$i] = $request->opciones_a[$i] . ',' . $request->opciones_b[$i] . ',' . $request->opciones_c[$i] . ',' . $request->opciones_d[$i];
                //$array_opciones = explode(',', $opciones[$i]);
                echo "Opciones: " . $opciones[$i] . "\n";
                //print_r($array_opciones);
                /*echo "Opcion a:" . $request->opciones_a[$i] . "\n";
                echo "Opcion b:" . $request->opciones_b[$i] . "\n";
                echo "Opcion c:" . $request->opciones_c[$i] . "\n";
                echo "Opcion d:" . $request->opciones_d[$i] . "\n";
                echo "Id pregunta: " . $request->pregunta_existente[$i] . "\n";*/
            //}
            //print_r($opciones);
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
    public function edit(Request $request, $codigoTest)
    {
        if (Gate::denies('modificar-test')){
            abort(403);
        }

        $test = Test::find($codigoTest);
        $test_has_preguntas = TestHasPreguntastest::where('test_codigoTest', '=', $codigoTest)->lists('preguntasTest_codigoPregunta');

        if ($test->descripcion != $request->descripcion) {
            $validar_descripcion = Validator::make($request->all(), [
                'descripcion' => ['required', 'max:100', 'unique:test'],
            ]);
            if ($validar_descripcion->fails()){
                return Redirect::to('test')
                    ->with('modal_message_error', 'La descripcion ingresada ya existe o no es válida, no se realizó la modificación');
            }
        }

        $opciones = [];
        $flag_crear_pregunta = [];
        $cant_preguntas = count($request->enunciado);
        for ($i = 0; $i < $cant_preguntas; $i++) {
            $opciones[$i] = $request->opciones_a[$i] . '#' . $request->opciones_b[$i] . '#' . $request->opciones_c[$i] . '#' . $request->opciones_d[$i];
            if (Preguntastest::where('codigoPregunta', '=', $request->pregunta_existente[$i])->get()->isEmpty()) {
                echo "La pregunta no existe, se va a crear y asociar";
                $validar_preguntas = Validator::make(['enunciado' => $request->enunciado[$i], 'opciones' => $opciones[$i]], [
                    'enunciado' => ['required', 'max:45'],
                    'opciones' => ['required', 'max:200'],
                ]);
                if ($validar_preguntas->fails()) {
                    return Redirect::to('test')
                        ->with("modal_message_error", "Los datos de la pregunta agregada no son válidos, no se ha realizado ninguna modificación");
                }
                else {
                    $flag_crear_pregunta[$i] = 1;
                }
            }
            else {
                $pregunta_seleccionada = Preguntastest::find($request->pregunta_existente[$i]);
                if ($pregunta_seleccionada->enunciado != $request->enunciado[$i] || $pregunta_seleccionada->opcionesRespuesta != $opciones[$i]) {
                    echo "la pregunta " . $pregunta_seleccionada->codigoPregunta." fue modificada, se van a actualizar los datos";
                    $validar_preguntas = Validator::make(['enunciado' => $request->enunciado[$i], 'opciones' => $opciones[$i]], [
                        'enunciado' => ['required', 'max:45'],
                        'opciones' => ['required', 'max:200'],
                    ]);
                    if ($validar_preguntas->fails()) {
                        return Redirect::to('test')
                            ->with("modal_message_error", "Los datos de la pregunta " . $pregunta_seleccionada->codigoPregunta . " modificada no son válidos, no se ha realizado ninguna modificación");
                    }
                    else {
                        $flag_crear_pregunta[$i] = 0;
                    }
                }
                else {
                    echo "la pregunta " . $pregunta_seleccionada->codigoPregunta." no fue modificada";
                    $flag_crear_pregunta[$i] = 2;
                }
            }
        }

        for ($i = 0; $i < $cant_preguntas; $i++) {
            if ($flag_crear_pregunta[$i] == 1) {
                $pregunta = Preguntastest::create([
                    'enunciado' => $request->enunciado[$i],
                    'opcionesRespuesta' => $opciones[$i],
                ]);
                if(TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->where('preguntasTest_codigoPregunta', '=', $pregunta->codigoPregunta)->get()->isEmpty()) {
                    TestHasPreguntastest::create([
                        'test_codigoTest'              => $test->codigoTest,
                        'test_tipoTest_codigoTipoTest' => $test->tipoTest_codigoTipoTest,
                        'preguntasTest_codigoPregunta' => $pregunta->codigoPregunta,
                    ]);
                }
            }
            elseif ($flag_crear_pregunta[$i] == 0) {
                $pregunta =  Preguntastest::find($request->pregunta_existente[$i]);
                $pregunta->fill([
                    'codigoPregunta' => $pregunta->codigoPregunta,
                    'enunciado' => $request->enunciado[$i],
                    'opcionesRespuesta' => $opciones[$i],
                ]);
                $pregunta->save();
            }
            elseif ($flag_crear_pregunta[$i] == 2) {
                $pregunta = Preguntastest::find($request->pregunta_existente[$i]);
                if(TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->where('preguntasTest_codigoPregunta', '=', $pregunta->codigoPregunta)->get()->isEmpty()) {
                    TestHasPreguntastest::create([
                        'test_codigoTest' => $test->codigoTest,
                        'test_tipoTest_codigoTipoTest' => $test->tipoTest_codigoTipoTest,
                        'preguntasTest_codigoPregunta' => $pregunta->codigoPregunta,
                    ]);
                }
            }
        }

        //print_r($request->pregunta_existente);
        //echo $test_has_preguntas;
        $preguntas_eliminar = $test_has_preguntas->diff($request->pregunta_existente)->all();
        //$preguntas_eliminar = $preguntas_eliminar->all();
        if (!empty($preguntas_eliminar)){
            foreach ($preguntas_eliminar as $i) {
                echo "Quitar pregunta del test: " . $i ;
                TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->where('preguntasTest_codigoPregunta', '=', $i)->delete();
            }
        }

        $test->fill([
            'descripcion' => $request->descripcion,
        ]);
        $test->save();

        return Redirect::to('test')
            ->with('modal_message_success', 'Test modificado satisfactoriamente');





        //echo "Codigo Test: " . $request->codigotest . "\n";
        //echo "Descripcion: " . $request->descripcion . "\n";
        //$opciones = [];
        /*for ($i = 0; $i < count($request->enunciado); $i++) {
            echo "Pregunta".$i."\n";
            echo "Enunciado:" . $request->enunciado[$i] . "\n";
            $opciones[$i] = $request->opciones_a[$i] . '#' . $request->opciones_b[$i] . '#' . $request->opciones_c[$i] . '#' . $request->opciones_d[$i];
            //$array_opciones = explode(',', $opciones[$i]);
            echo "Opciones: " . $opciones[$i] . "\n";
            /*echo "Opcion a:" . $request->opciones_a[$i] . "\n";
            echo "Opcion b:" . $request->opciones_b[$i] . "\n";
            echo "Opcion c:" . $request->opciones_c[$i] . "\n";
            echo "Opcion d:" . $request->opciones_d[$i] . "\n";*/
            //echo "Id pregunta: " . $request->pregunta_existente[$i] . "\n";
        //}


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

        if (Gate::denies('eliminar-test')){
            abort(403);
        }

        $no_eliminados = array();
        $eliminados = array();
        $tests = $request->eliminar;
        if (!empty($tests)) {
            foreach ($tests as $codigoTest) {
                $test = Test::where('codigoTest', '=', $codigoTest)->get()->first();
                if (UsersHasTest::where('test_codigoTest', '=', $test->codigoTest)->get()->isEmpty()) {
                    if (!TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->get()->isEmpty()) {
                        TestHasPreguntastest::where('test_codigoTest', '=', $test->codigoTest)->delete();
                    }
                    $eliminados = array_add($eliminados, $test->codigoTest, $test->codigoTest);
                    $test->delete();
                }
                else {
                    $no_eliminados = array_add($no_eliminados, $test->codigoTest, $test->codigoTest);
                }
            }
            if (empty($no_eliminados)) {
                return Redirect::to('test')
                    ->with("modal_message_success", "Los tests han sido eliminados de forma exitosa!");
            }
            else {
                return Redirect::to('test')
                    ->with("modal_message_error", 'No se han eliminado los siguientes test porque están asignados a un usuario: ' . implode(", ", $no_eliminados));
            }
        }
        else {
            return Redirect::to('test')
                ->with("modal_message_error", "No se ha seleccionado ningun test");
        }
    }

    public function destroyPregunta(Request $request)
    {
        if (Gate::denies('eliminar-test')){
            abort(403);
        }
        $no_eliminada = array();
        $eliminada = array();
        $pregunta = $request->pregunta;
        if (!empty($pregunta)) {
            $tests = TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->select('test_codigoTest')->get();
            if (UsersHasTest::whereIn('test_codigoTest', $tests)->where('estadoTest', '=', 0)->get()->isEmpty()) {
                if (!TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->get()->isEmpty()) {
                    TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->delete();
                }
                if (!Respuesta::where('preguntasTest_codigoPregunta', '=', $pregunta)->get()->isEmpty()) {
                    Respuesta::where('preguntasTest_codigoPregunta', '=', $pregunta)->delete();
                }
                $eliminada = array_add($eliminada, $pregunta, $pregunta);
                Preguntastest::where('codigoPregunta', '=', $pregunta)->delete();
            }
            else {
                $no_eliminada = array_add($no_eliminada, $pregunta, $pregunta);
            }

            if (empty($no_eliminada)) {
                return back()
                    ->with("modal_message_success", "La pregunta ha sido eliminada de forma exitosa!");
            }
            else {
                return back()
                    ->with("modal_message_error", 'No se ha eliminado la siguiente pregunta porque está asignada a un test asignado a algún usuario: ' . implode(", ", $no_eliminada));
            }
        }
        else {
            return back()
                ->with("modal_message_error", "No se ha seleccionado ninguna pregunta");
        }

    }

    public function destroyPreguntaModificar($codigoPregunta)
    {
        if (Gate::denies('eliminar-test')){
            abort(403);
        }
        $no_eliminada = array();
        $eliminada = array();
        $pregunta = $codigoPregunta;
        if (!empty($pregunta)) {
            $tests = TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->select('test_codigoTest')->get();
            if (UsersHasTest::whereIn('test_codigoTest', $tests)->where('estadoTest', '=', 0)->get()->isEmpty()) {
                if (!TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->get()->isEmpty()) {
                    TestHasPreguntastest::where('preguntasTest_codigoPregunta', '=', $pregunta)->delete();
                }
                if (!Respuesta::where('preguntasTest_codigoPregunta', '=', $pregunta)->get()->isEmpty()) {
                    Respuesta::where('preguntasTest_codigoPregunta', '=', $pregunta)->delete();
                }
                $eliminada = array_add($eliminada, $pregunta, $pregunta);
                Preguntastest::where('codigoPregunta', '=', $pregunta)->delete();
            }
            else {
                $no_eliminada = array_add($no_eliminada, $pregunta, $pregunta);
            }

            if (empty($no_eliminada)) {
                return back()
                    ->with("modal_message_success", "La pregunta ha sido eliminada de forma exitosa!");
            }
            else {
                return back()
                    ->with("modal_message_error", 'No se ha eliminado la siguiente pregunta porque está asignada a un test asignado a algún usuario: ' . implode(", ", $no_eliminada));
            }
        }
        else {
            return back()
                ->with("modal_message_error", "No se ha seleccionado ninguna pregunta");
        }

    }


    public function destroyAsignacionTest(Request $request)
    {
        if (Gate::denies('cancelar-test')){
            abort(403);
        }

        if (!empty($request->cancelar_test)) {
            $cancelar_test = [];
            //$i=0;
            foreach ($request->cancelar_test as $test_user) {
                $cancelar_test = explode(',', $test_user);
                UsersHasTest::where('test_codigoTest', '=', $cancelar_test[0])
                    ->where('users_id', '=', $cancelar_test[1])
                    ->delete();
                //print_r($cancelar_test);
                //$i++;
            }
            return back()
                ->with("modal_message_success", "Se han cancelado las asignaciones seleccionadas");
            //print_r($cancelar_test);
            //$cancelar_test[0] = explode(',', $request->cancelar_test[0]);
            //print_r($cancelar_test);
        }
        else {
            return back()
                ->with("modal_message_error", "No se ha seleccionado ninguna asignacion de test");
        }
    }


    public function agregarComentario(Request $request, $id, $codigoTest)
    {
        if (Gate::denies('agregar-comentario')){
            abort(403);
        }

        $user_test = UsersHasTest::where('users_id', '=', $id)->where('test_codigoTest', '=', $codigoTest)->get()->first();
        if ($user_test->estadoTest == 0) {
            return back()
                ->with("modal_message_error", "El estudiante no ha realizado el test");
        }
        else {
            if (empty($request->comentario)){
                $user_test->fill([
                    'diagnostico' => null,
                ]);
                $user_test->save();
                return back()
                    ->with("modal_message_success", "Se ha ingresado el comentario satisfactoriamente");
            }
            else {
                if ($user_test->diagnostico != $request->comentario) {
                    $validar_comentario = Validator::make($request->all(), [
                        'comentario' => ['required', 'max:45'],
                    ]);
                    if ($validar_comentario->fails()){
                        return back()
                            ->with('modal_message_error', 'No ha ingresado un comentario válido');
                    }
                }

                $user_test->fill([
                    'diagnostico' => $request->comentario,
                ]);
                $user_test->save();
                return back()
                    ->with('modal_message_success', 'Se ha ingresado el comentario satisfactoriamente');
            }
        }
    }


    public function realizarTest($codigoTest)
    {
        if (Gate::denies('realizar-test')){
            abort(403);
        }

        $test = Test::find($codigoTest);
        $preguntas = Preguntastest::whereIn('codigoPregunta', TestHasPreguntastest::where('test_codigoTest', '=', $codigoTest)->select('preguntasTest_codigoPregunta')->get())->get();
        $board_user = 'b_estudiante';

        /*echo $preguntas;
        $opciones = explode('#', $preguntas[0]->opcionesRespuesta);
        print_r($opciones);*/
        return view('realizar_test', compact('test', 'preguntas', 'board_user'));
    }


    private function validarRespuesta($a, $b, $c, $d)
    {
        if (($a==$b) || ($a==$c) ||($a==$d)){
            return false;
        }
        elseif(($b==$c) || ($b==$d)) {
            return false;
        }
        elseif ($c==$d) {
            return false;
        }
        else {
            return true;
        }
    }

    public function respuestasTest(Request $request)
    {
        //print_r($request->all());
        $respuestas = [];
        $cant_preguntas = count($request->codigopregunta);
        $EC = 0;
        $OR = 0;
        $CA = 0;
        $EA = 0;
        for ($i=0; $i<$cant_preguntas; $i++) {
            //$flag_guardar_respuestas = [];
            if ($this->validarRespuesta($request->respuesta_A[$i],$request->respuesta_B[$i],$request->respuesta_C[$i],$request->respuesta_D[$i])) {
                $respuestas[$i] = $request->respuesta_A[$i] . '#' . $request->respuesta_B[$i] . '#' . $request->respuesta_C[$i] . '#' . $request->respuesta_D[$i];
                $EC += $request->respuesta_A[$i];
                $OR += $request->respuesta_B[$i];
                $CA += $request->respuesta_C[$i];
                $EA += $request->respuesta_D[$i];
            }
            else {
                //echo "respuesta " . $i . " incorrecta\n";
                return back()
                    ->with('modal_message_error', 'no puede repetir numeros en la pregunta: ' . ($i+1))
                    ->withInput();
            }
        }
        for ($i=0; $i<$cant_preguntas; $i++) {
            Respuesta::create([
                'preguntasTest_codigoPregunta' => $request->codigopregunta[$i],
                'users_id' => $request->id,
                'users_tipoUsuario_codigoTipoUsuario' => 3,
                'respuesta' => $respuestas[$i],
            ]);
        }
        $user_test = UsersHasTest::where('users_id', '=', $request->id)->where('test_codigoTest', '=', $request->codigotest)->get()->first();
        $user_test->estadoTest = 1;
        //print_r($respuestas);
        /*echo $EC . "\n";
        echo $OR . "\n";
        echo $CA . "\n";
        echo $EA . "\n";*/
        $CA_EC = $CA-$EC;
        $EA_OR = $EA-$OR;

        $resultado = '';
        if ($EA_OR >= 5) {
            if ($CA_EC >=4) {
                $resultado = 'Convergente';
            }
            else {
                $resultado = 'Adaptador';
            }
        }
        else {
            if ($CA_EC >=4) {
                $resultado = 'Asimilador';
            }
            else {
                $resultado = 'Divergente';
            }
        }

        $user_test->resultado = $resultado;
        $user_test->save();
        return Redirect::to('test')
            ->with('modal_message_success', 'Test solucionado correctamente, ya puede visualizar su resultado');
    }
}
