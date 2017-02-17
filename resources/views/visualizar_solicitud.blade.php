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

    <h1 class="page-header">Gestión de Solicitudes</h1>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                    <div class="table-responsive">
                        <div class="form-group pull-right col-md-4">
                            <input type="text" class="search form-control" placeholder="¿Qué estas buscando?">
                        </div>
                        <span class="counter pull-right"></span>
                        <table id="mytable" class="table table-bordered table-hover table-striped results">
                            <thead>
                            <tr>
                                <th>Solicitud</th>
                                <th></th>
                            </tr>
                            <tr class="warning no-result">
                                <td colspan="11"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($solicitudes as $solicitud)
                                <tr>
                                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 0)
                                        <td> Creación de usuario <strong>Administrador {{$solicitud->nombre }} {{$solicitud->apellido}}</strong> </td>
                                    @else
                                        @if($solicitud->tipoUsuario_codigoTipoUsuario == 2)
                                            <td> Creación de usuario <strong> Psicologo {{$solicitud->nombre }} {{$solicitud->apellido}}</strong> </td>
                                        @else
                                            <td> Creación de usuario <strong> Estudiante {{$solicitud->nombre }} {{$solicitud->apellido}}</strong> </td>
                                        @endif
                                    @endif
                                    <td><p data-placement="top" data-toggle="tooltip" title="Abrir"><button type="button" class="btn btn-primary btn-xs" data-title="Visualizar" data-toggle="modal" data-target="#visualizar" data-id="{!! $solicitud->id  !!}" data-nombre="{{$solicitud->nombre}}" data-apellido="{{$solicitud->apellido}}" data-email="{{$solicitud->email}}" data-tipodocumento="{{$solicitud->tipoDocumento}}" data-fechanacimiento="{{$solicitud->fechaNacimiento}}" data-password="{{$solicitud->password}}" data-genero="{{$solicitud->genero}}" data-telefono="{{$solicitud->telefono}}" data-institucion="{{$solicitud->institucion_codigoInstitucion}}" data-grupo="{{$solicitud->grupo_codigoGrupo}}" data-usuario="{{ $solicitud->tipoUsuario_codigoTipoUsuario }}"><i class="fa fa-external-link-square" aria-hidden="true"></i></button></p></td>
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
<form id="responderSolicitud" class="form-horizontal" role="form" method="POST">
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="edit" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Responder Solicitud</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('responder_solicitud')
                </div>
                <div class="modal-footer ">
                    <button id="aceptar" type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
                    <button id="rechazar" type="submit" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-ok-sign"></span> Rechazar</button>
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
    <script src="{{asset('js/modal_solicitudes.js')}}"></script>
    <script src="{{asset('js/checkbox.js')}}"></script>
@endsection