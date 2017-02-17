@if (Auth::check())
    <?php $logged_user = Auth::user(); ?>
@else
    {{abort(403)}}
@endif

@extends('boards/' . $board_user)

@section('content_user')
    {{ $logged_user->nombre }} {{$logged_user->apellido}}
@endsection

@section('content')
    <!--<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    @if($logged_user->tipoUsuario_codigoTipoUsuario == 0)
        <?php $user = 'Root' ?>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 1)
        <?php $user = 'Administrador' ?>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
        <?php $user = 'Psicologo' ?>
    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 3)
        <?php $user = 'Estudiante' ?>
    @endif
    <h1 class="page-header">
        <div style="text-align: center;"> <i class="fa fa-fw fa-user fa-1g"></i>Perfil {{$user}} </div>
    </h1>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="modificarCuenta" class="form-horizontal" role="form" method="POST" action="{{url('home/modificar/' . $logged_user->id)}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Tipo de Documento') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::select('tipoDocumento',['CC' => 'CC','TI' => 'TI'],$logged_user->tipoDocumento,['id' => 'tipoDocumento', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Número Documento') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('id', $logged_user->id, ['id' => 'id', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '11', 'minlength' => '10'])!!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Nombre') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('nombre',$logged_user->nombre,['id' => 'nombre', 'class' => 'form-control', 'required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Apellido') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('apellido',$logged_user->apellido,['id' => 'apellido', 'class' => 'form-control', 'required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Fecha de nacimiento') !!}</h4>
                        </div>
                        <div class="col-md-2">
                            {!! Form::date('fechaNacimiento', $logged_user->fechaNacimiento, ['id' => 'fechaNacimiento', 'class' => 'form-control'])!!}
                        </div>
                        <div class="col-md-1">
                            <h4>{!! Form::label('Genero') !!}</h4>
                        </div>
                        <div class="col-md-2">
                            {!! Form::select('genero', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],$logged_user->genero,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Teléfono') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('telefono',$logged_user->telefono,['class' => 'form-control', 'required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Correo electrónico') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('email',$logged_user->email,['class' => 'form-control', 'required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Contraseña') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password" value="{{$logged_user->password}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Confirmar contraseña') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 0)
                        <?php $hidden_inst = 'hidden' ?>
                    @else
                        <?php $hidden_inst = '' ?>
                    @endif
                    <div class="form-group row {{$hidden_inst}}">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <h4>{!! Form::label('Institución') !!}</h4>
                        </div>
                        <div class="col-md-5">
                            {!! Form::select('institucion_codigoInstitucion', $institucion, $logged_user->institucion_codigoInstitucion ,['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>

                    @if($logged_user->tipoUsuario_codigoTipoUsuario == 3)
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <h4>{!! Form::label('Grupo') !!}</h4>
                            </div>
                            <div class="col-md-5">
                                {!! Form::text('grupo_codigoGrupo', $logged_user->grupo_codigoGrupo ,['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    @elseif($logged_user->tipoUsuario_codigoTipoUsuario == 2)
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <h4>{!! Form::label('Grupos') !!}</h4>
                            </div>
                            <div class="col-md-5">
                                {!! Form::select('grupo_CodigoGrupo', $grupos, null ,['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                    @endif

                    <div class="form-group buttonHolder">
                            <button type="submit" class="btn btn-success">
                                Modificar
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection