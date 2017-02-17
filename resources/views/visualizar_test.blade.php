@if (Auth::check())
    <?php $logged_user = Auth::user(); ?>
    {{ $logged_user->nombre}}
@else
    {{abort(403)}}
@endif

@extends('boards/' . $board_user)

@section('content_user')
    {{ $logged_user->nombre }} {{$logged_user->apellido}}
@endsection

@section('content')

    @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
        <h1 class="page-header">Gestión de Test</h1>
        <p></p>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 text-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#crear_test">
                            <i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Crear Test</button>
                        <button class="btn btn-danger" data-toggle="modal"
                                data-target="#eliminar_test">
                            <i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i>Eliminar Test</button>
                    </div>
                </div>
        <p></p>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
        <h1 class="page-header">Gestión de Test</h1>
        <p></p>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
                <button class="btn btn-danger" data-toggle="modal"
                        data-target="#cancelar_asignacion">
                    <i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i>Cancelar Test</button>
            </div>
        </div>
        <p></p>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 3)
        <h1 class="page-header">Mis Test</h1>
    @endif

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
                    <form id="eliminarTest" class="form-horizontal" role="form" method="POST" action="{{url('test/eliminar')}}" onkeypress="return event.keyCode != 13;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                    <form id="cancelarAsignacion" class="form-horizontal" role="form" method="POST" action="{{url('test/cancelar_asignacion')}}" onkeypress="return event.keyCode != 13;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @endif

                    <div class="table-responsive">
                        <div class="form-group pull-right col-md-4">
                            <input type="text" class="search form-control" placeholder="¿Qué estas buscando?">
                        </div>
                        <span class="counter pull-right"></span>
                        <table id="mytable" class="table table-bordered table-hover table-striped results">
                            <thead>
                            <tr>
                                @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
                                    <th>Codigo Test</th>
                                    <th class="col-md-9">Tipo Test</th>
                                    <th class="col-md-8">Descripción</th>
                                    <th class="col-md-8">IDs Preguntas</th>
                                    <!--<th class="col-md-7">Resultado</th>
                                    <th class="col-md-6">Diagnostico</th>-->
                                    <th>Editar</th>
                                    <th class="text-center"><input type="checkbox" id="checkall"></th>
                                @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                                    <th>Descripción Test</th>
                                    <th>Estudiante</th>
                                    <th>Grupo</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <th>Comentario</th>
                                    <th>Añadir Comentario</th>
                                    <th class="text-center"><input type="checkbox" id="checkall"></th>
                                @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 3)
                                    <th>Descripción Test</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <th>Comentario</th>
                                    <th></th>
                                @endif
                            </tr>
                            <tr class="warning no-result">
                                <td colspan="7"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
                                @foreach($tests as $test)
                                    <tr>
                                        <td scope="row">{{$test->codigoTest}}</td>
                                        <td>
                                            @if($test->tipoTest_codigoTipoTest == 0)
                                                <span class="label label-default">Test de Kolb</span>
                                            @else
                                                <span class="label label-default">Ventana de Johari</span>
                                            @endif
                                        </td>
                                        <td>{{$test->descripcion}}</td>

                                        <?php
                                            if(empty($test_has_preguntas[$test->codigoTest])) {
                                                $preguntas= "";
                                            }
                                            else {
                                                $preguntas = $test_has_preguntas[$test->codigoTest];
                                            }

                                            $preguntas = [];
                                            foreach($test_has_preguntas as $has_pregunta) {
                                                if ($has_pregunta->test_codigoTest == $test->codigoTest) {
                                                    $preguntas[count($preguntas)] = $has_pregunta->preguntasTest_codigoPregunta;
                                                }
                                            }

                                            $string_preguntas = implode(",", $preguntas);

                                        ?>

                                        <td>{{$string_preguntas}}</td>

                                        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
                                            <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="button" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-codigotest = "{{ $test->codigoTest }}" data-numeropreguntas = "{{count($preguntas)}}" data-descripcion = "{{$test->descripcion}}" data-preguntas = {{$string_preguntas . ","}}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p></td>
                                            <td><input id="eliminar_tests" type="checkbox" class="checkthis" name="eliminar[]" value="{{$test->codigoTest}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
                                        @endif
                                    </tr>
                                @endforeach
                            @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                                @foreach($users_has_tests as $test)
                                    <tr>
                                        <td>{{$test->descripcion}}</td>
                                        <td>{{$test->nombre}} {{$test->apellido}}</td>
                                        <td>{{$test->grupo_codigoGrupo}}</td>
                                        @if($test->estadoTest == 0)
                                            <td>No terminado</td>
                                        @else
                                            <td>Terminado</td>
                                        @endif
                                        <td>{{$test->resultado}}</td>
                                        <td>{{$test->diagnostico}}</td>
                                        <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Comentario"><button type="button" class="btn btn-primary btn-md" data-title="Comentario" data-toggle="modal" data-target="#comentario" data-codigotest = "{{ $test->codigoTest }}" data-id = "{{ $test->id }}" data-comentario = "{{$test->diagnostico}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p></td>
                                        <td class="text-center"><input id="cancelar_tests" type="checkbox" class="checkthis" name="cancelar_test[]" value="{{$test->codigoTest.",".$test->id}}"> </td>
                                    </tr>
                                @endforeach
                            @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 3)
                                @foreach($user_has_tests as $test)
                                    <tr>
                                        <td>{{$test->descripcion}}</td>
                                        @if($test->estadoTest == 0)
                                            <td>No terminado</td>
                                        @else
                                            <td>Terminado</td>
                                        @endif
                                        <td>{{$test->resultado}}</td>
                                        <td>{{$test->diagnostico}}</td>
                                        @if($test->estadoTest == 0)
                                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{url('test/realizar/' . $test->codigoTest)}}"><i class="fa fa-fw fa-pencil-square-o fa-lg" aria-hidden="true"></i>Realizar</a></td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

    @section('modal-content')
        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
            <div class="modal fade" id="eliminar_test" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Eliminar Test</h4>

                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de eliminar los test seleccionados?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Eliminar Test</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </form>
        @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
            <div class="modal fade" id="cancelar_asignacion" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Cancelar Test</h4>

                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de cancelar los test seleccionados?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Cancelar Test</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </form>
        @endif

        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
            <div class="modal fade" id="crear_test" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Crear test</h4>

                        </div>
                        <div class="modal-body">

                            <div class="alert alert-info"><span class="glyphicon glyphicon-alert"></span> ¿Qué tipo de test desea crear?</div>
                            <div class="text-center">
                                <a class="btn btn-default" href="{{url('test/crear')}}"> Test de Kolb</a>
                                <a class="btn btn-default"> Ventana de Johari</a>
                            </div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <form id="modificarTest" class="form-horizontal" role="form" method="POST">
                <div class="modal fade" id="edit" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Modificar Test</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('modificar_test')
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Actualizar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </form>
        @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
            <form id="agregarComentario" class="form-horizontal" role="form" method="POST">
                <div class="modal fade" id="comentario" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Añadir Comentario</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('agregar_comentario')
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Añadir</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </form>
        @endif
    @endsection


@endsection

@section('scripts')
    <script src="{{asset('js/form-search.js')}}"></script>
    <script src="{{asset('js/checkbox.js')}}"></script>
    @if($logged_user->tipoUsuario_codigoTipoUsuario == 1)
        <script src="{{asset('js/modal_modificar_test.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
        <script src="{{asset('js/modal_agregar_comentario.js')}}"></script>
    @endif
    <script type="text/javascript">
        $('input, select').keypress(function(event) { return event.keyCode != 13; });
    </script>
@endsection