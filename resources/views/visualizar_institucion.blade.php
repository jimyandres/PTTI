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

    <h1 class="page-header">Gestión de Instituciones</h1>
        @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)

            <p></p>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-1"></div>
                <div class="col-md-5 text-right">
                    <a class="btn btn-success" href="{{url('/instituciones/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir Institución</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Instituciones</button>
                </div>
            </div>
            <p></p>

            <!--<p>
                <div class="col-md-offset-8">
                    <a class="btn btn-success" href="{{url('/instituciones/ingresar')}}"><i class="fa fa-fw fa-plus fa-lg" aria-hidden="true"></i>Añadir Institución</a>
                    <!--<a class="btn btn-primary " href="">Modificar usuario</a>--
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-fw fa-trash fa-lg" aria-hidden="true"></i> Eliminar Instituciones</button>
                </div>
            <div class="row"></div>
            </p>-->
        @endif

    <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="eliminarInstitucion" class="form-horizontal" role="form" method="POST" action="{{url('instituciones/eliminar')}}" onkeypress="return event.keyCode != 13;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="table-responsive">
                        <div class="form-group pull-right col-md-4">
                            <input type="text" class="search form-control" placeholder="¿Qué estas buscando?">
                        </div>
                        <span class="counter pull-right"></span>
                        <table id="mytable" class="table table-bordered table-hover table-striped results">
                            <thead>
                            <tr>
                                <th class="col-md-7">NIT</th>
                                <th class="col-md-6">Nombre</th>
                                <th class="col-md-5">Direccion</th>
                                <th class="col-md-4">telefono</th>
                                <th class="col-md-3">Sitio web</th>
                                <th class="col-md-2">Ciudad</th>
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
                            @foreach($instituciones as $institucion)
                                <tr>
                                    <th scope="row">{{$institucion->codigoInstitucion}}</th>
                                    <td>{{$institucion->nombre}}</td>
                                    <td>{{$institucion->direccion}}</td>
                                    <td>{{$institucion->telefono}}</td>
                                    <td>{{$institucion->sitioWeb}}</td>
                                    <td>{{$institucion->ciudad}}</td>
                                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 1 || $logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                        <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="button" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-id="{!! $institucion->codigoInstitucion  !!}" data-nombre="{{$institucion->nombre}}" data-direccion="{{$institucion->direccion}}" data-telefono="{{$institucion->telefono}}" data-sitioweb="{{$institucion->sitioWeb}}" data-ciudad="{{$institucion->ciudad}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p></td>
                                        <td><input id="eliminar_instituciones" type="checkbox" class="checkthis" name="eliminar[]" value="{{$institucion->codigoInstitucion}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    <h4 class="modal-title custom_align" id="Heading">Eliminar instituciones</h4>

                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de eliminar las instituciones seleccionadas?</div>

                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Eliminar Instituciones</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </form>

    <form id="modificarInstitucion" class="form-horizontal" role="form" method="POST">
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Modificar Institución</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('modificar_institucion')
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
    <script src="{{asset('js/modal_modificar_instituciones.js')}}"></script>
    <script type="text/javascript">
        $('input, select').keypress(function(event) { return event.keyCode != 13; });
    </script>
@endsection