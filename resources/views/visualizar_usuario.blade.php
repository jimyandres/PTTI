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

        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
            <h1 class="page-header">Gestión de Usuarios</h1>

            <p></p>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-success" href="{{url('usuarios/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir usuarios</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Usuarios</button>
                </div>
            </div>
            <p></p>

            <!--    <p>
                <div class="col-md-offset-8">
                        <a class="btn btn-success" href="{{url('usuarios/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir usuarios</a>
                        <!--<a class="btn btn-primary " href="">Modificar usuario</a>--
                        <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Usuario</button>
                </div>
                <div class="row"></div>
                </p>-->
        @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
            <h1 class="page-header">Usuarios Registrados</h1>

            <p></p>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#asignar_test" ><i class="fa fa-fw fa-file-text-o fa-lg" aria-hidden="true"></i> Asignar Test</button>
                </div>
            </div>
            <p></p>
        @endif

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                        <form id="eliminarUsuario" class="form-horizontal" role="form" method="POST" action="{{url('usuarios/eliminar')}}" onkeypress="return event.keyCode != 13;">
                    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                        <form id="asignarTest" class="form-horizontal" role="form" method="POST" action="{{url('usuarios/test/asignar')}}" onkeypress="return event.keyCode != 13;">
                    @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="table-responsive">
                        <div class="form-group pull-right col-md-4">
                            <input id="buscar_usuarios" type="text" class="search form-control" placeholder="¿Qué estas buscando?">
                        </div>
                        <span class="counter pull-right"></span>
                        <table id="mytable" class="table table-bordered table-hover table-striped results">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th class="col-md-8">Nombre</th>
                                <th class="col-md-7">Email</th>
                                <th class="col-md-6">Doc.</th>
                                <th class="col-xs-5">Fecha Nacimiento</th>
                                <th class="col-md-4">Telefono</th>
                                <th class="col-md-3">Institucion</th>
                                <th class="col-md-2">Grupo</th>
                                <th class="col-md-1">Tipo de Usuario</th>
                                @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                    <th>Editar</th>
                                    <th><input type="checkbox" id="checkall"></th>
                                @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                                    <th><input type="checkbox" id="checkall"></th>
                                @endif
                            </tr>
                            <tr class="warning no-result">
                                <td colspan="11"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td scope="row">{{$usuario->id}}</td>
                                    <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>{{$usuario->tipoDocumento}}</td>
                                    <td>{{$usuario->fechaNacimiento}}</td>
                                    <td>{{$usuario->telefono}}</td>
                                    <?php $inst = \App\Models\Institucion::where('codigoInstitucion', $usuario->institucion_codigoInstitucion)->get()->first();?>
                                    <td>{{$inst->nombre}}</td>
                                    <?php
                                        $grupo = \App\Models\Grupo::where('codigoGrupo', $usuario->grupo_codigoGrupo)
                                                ->where('institucion_codigoInstitucion', $usuario->institucion_codigoInstitucion)
                                                ->get()
                                                ->first();
                                    ?>
                                    @if(empty($grupo))
                                        <?php $grupo_new = "" ?>
                                    @else
                                        <?php $grupo_new = $grupo->codigoGrupo; ?>
                                    @endif
                                    <td>{{$grupo_new}}</td>
                                    <?php
                                        $tipo_usuarios = \App\Models\Tipousuario::where('codigoTipoUsuario', $usuario->tipoUsuario_codigoTipoUsuario)->get()->first();
                                    ?>
                                    <td>
                                        @if($tipo_usuarios->nombre == 'administrador')
                                            <span class="label label-default">{{ $tipo_usuarios->nombre }}</span>
                                        @elseif($tipo_usuarios->nombre == 'psicologo')
                                            <span class="label label-info">{{ $tipo_usuarios->nombre }}</span>
                                        @elseif($tipo_usuarios->nombre == 'estudiante')
                                            <span class="label label-primary">{{ $tipo_usuarios->nombre }}</span>
                                        @endif
                                    </td>
                                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                        <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="button" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-id="{!! $usuario->id  !!}" data-nombre="{{$usuario->nombre}}" data-apellido="{{$usuario->apellido}}" data-email="{{$usuario->email}}" data-tipodocumento="{{$usuario->tipoDocumento}}" data-fechanacimiento="{{$usuario->fechaNacimiento}}" data-genero="{{$usuario->genero}}" data-telefono="{{$usuario->telefono}}" data-institucion="{{$usuario->institucion_codigoInstitucion}}" data-grupo="{{$grupo_new}}" data-usuario="{{ $usuario->tipoUsuario_codigoTipoUsuario }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p></td>
                                        <td><input id="eliminar_usuarios" type="checkbox" class="checkthis" name="eliminar[]" value="{{$usuario->id}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
                                    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                                        <td><input id="asignar_usuarios" type="checkbox" class="checkthis" name="asignar_usuarios[]" value="{{$usuario->id}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
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
        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Eliminar usuarios</h4>

                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de eliminar los usuarios seleccionados?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Eliminar Usuarios</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </form>
        @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
            <div class="modal fade" id="asignar_test" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align text-center" id="Heading"><i class="fa fa-fw fa-plus-square fa-lg" aria-hidden="true"></i>Asignar Test</h4>

                        </div>
                        <div class="modal-body">

                            @include('asignar_test')

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Asignar Test</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </form>
        @endif

        <form id="modificarUsuario" class="form-horizontal" role="form" method="POST">
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Modificar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('modificar_usuario')
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
        <script src="{{asset('js/form-search_modal.js')}}"></script>
        <script src="{{asset('js/checkbox.js')}}"></script>
        <script src="{{asset('js/checkbox_modal.js')}}"></script>
        <script src="{{asset('js/modal_modificar_usuarios.js')}}"></script>
        <script type="text/javascript">
            $('input, select').keypress(function(event) { return event.keyCode != 13; });
        </script>
    @endsection