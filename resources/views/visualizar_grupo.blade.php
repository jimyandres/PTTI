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
            <h1 class="page-header">Gestión de Grupos</h1>
            <p></p>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-success" href="{{url('/grupos/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir Grupo</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Grupo</button>
                </div>
            </div>
            <p></p>

            <!--<p>
            <div class="col-md-offset-8">
                <a class="btn btn-success" href="{{url('/grupos/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir Grupo</a>
                <!--<a class="btn btn-primary " href="">Modificar usuario</a>--
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Grupo</button>
            </div>
            <div class="row"></div>
            </p>-->
        @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
            <h1 class="page-header">Grupos Registrados</h1>
        @endif

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="eliminarGrupo" class="form-horizontal" role="form" method="POST" action="{{url('grupos/eliminar')}}" onkeypress="return event.keyCode != 13;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="table-responsive">
                    <div class="form-group pull-right col-md-4">
                        <input type="text" class="search form-control" placeholder="¿Qué estas buscando?">
                    </div>
                    <span class="counter pull-right"></span>
                    <table id="mytable" class="table table-hover table-bordered table-striped results">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th class="col-md-5">Clasificacion</th>
                            <th class="col-md-4">Jornada</th>
                            <th class="col-md-3">Grado</th>
                            <th class="col-md-2">Institucion</th>
                            <th class="col-md-2">Psicologo</th>
                            @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                <th>Editar</th>
                                <th><input type="checkbox" id="checkall"></th>
                            @endif
                        </tr>
                        <tr class="warning no-result">
                            <td colspan="8"><i class="fa fa-warning"></i> No result</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grupos as $grupo)
                            <tr>
                                <th scope="row">{{$grupo->codigoGrupo}}</th>
                                <td>{{$grupo->clasificacion}}</td>
                                <td>{{$grupo->jornada}}</td>
                                <td>{{$grupo->grado}}</td>
                                <?php $inst = \App\Models\Institucion::where('codigoInstitucion', $grupo->institucion_codigoInstitucion)->get()->first();?>
                                <td>{{$inst->nombre}}</td>
                                <?php
                                    if(!empty( $psicologos[$grupo->codigoGrupo])) {
                                        $psicologo = $psicologos[$grupo->codigoGrupo];
                                    }
                                    else {
                                        $psicologo = "";
                                    }
                                    $usuario = \App\User::where('id', '=', $psicologo)->get()->first();
                                ?>
                                    @if(empty($usuario))
                                        <?php $id_usuario = null ?>
                                        <td>{{""}}</td>
                                    @else
                                        <?php $id_usuario = $usuario->id ?>
                                        <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
                                        <!--$asignado = $usuario->nombre . " " . $usuario->apellido;-->
                                    @endif
                                <!--<td></td>-->
                                @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="button" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-id="{{$grupo->codigoGrupo}}" data-clasificacion="{{$grupo->clasificacion}}" data-jornada="{{$grupo->jornada}}" data-grado="{{$grupo->grado}}" data-institucion="{{$grupo->institucion_codigoInstitucion}}" data-psicologo="{{$id_usuario}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p></td>
                                    <td><input id="eliminar_instituciones" type="checkbox" class="checkthis" name="eliminar[]" value="{{$grupo->codigoGrupo}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Eliminar grupos</h4>

                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de eliminar los grupos seleccionados?</div>

                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Eliminar Grupos</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </form>

    <form id="modificarGrupo" class="form-horizontal" role="form" method="POST">
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Modificar Grupo</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('modificar_grupo')
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{asset('js/form-search.js')}}"></script>
    <script src="{{asset('js/checkbox.js')}}"></script>
    <script src="{{asset('js/modal_modificar_grupos.js')}}"></script>
    <script type="text/javascript">
        $('input, select').keypress(function(event) { return event.keyCode != 13; });
    </script>
@endsection