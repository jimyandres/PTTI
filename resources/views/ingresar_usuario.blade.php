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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ingresar usuario</div>
                    <div class="panel-body">
                        @include('partials/errors')

                        <form class="form-horizontal" role="form" method="POST" action="{{url('usuarios')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de usuario</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipoUsuario_codigoTipoUsuario', [ '1' => 'Administrador', '2' => 'Psicologo', '3' => 'Estudiante'], null, ['id' => 'tipoUsuario_codigoTipoUsuario', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de Documento</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipoDocumento', ['CC' => 'CC','TI' => 'TI'], null, ['id' => 'tipoDocumento', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">ID</label>
                                <div class="col-md-6">
                                    <!--<input type="number" class="form-control" name="id" value="{{old('id')}}" onkeypress="return soloNumeros(event)">-->
                                    {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '11', 'minlength' => '10'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" onkeypress="return soloLetras(event)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Apellido</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" onkeypress="return soloLetras(event)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de nacimiento</label>
                                <div class="col-md-6">
                                    {!! Form::date('fechaNacimiento', \Carbon\Carbon::now(), ['id' => 'fechaNacimiento', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirmar contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Genero</label>
                                <div class="col-md-6">
                                    {!! Form::select('genero', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino', 'Otro' => 'Otro'], null, ['id' => 'genero', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Telefono</label>
                                <div class="col-md-6">
                                    {!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '7'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Institucion</label>
                                <div class="col-md-6">
                                    {!! Form::select('institucion_codigoInstitucion', $institucion, null, ['id' => 'institucion_codigoInstitucion', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Grupo</label>
                                <div class="col-md-6">
                                    {!! Form::select('grupo_codigoGrupo',['placeholder' => ''], null, ['id' => 'grupo_codigoGrupo', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>
                                    <a class="btn btn-primary" href="{{url('usuarios')}}">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/dropdown_users.js') !!}
@endsection