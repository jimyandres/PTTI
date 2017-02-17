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
                    <div class="panel-heading">Ingresar Grupo</div>
                    <div class="panel-body">
                        @include('partials/errors')

                        <script>
                            function soloNumeros(e){
                                key = e.keyCode || e.which;
                                tecla = String.fromCharCode(key);
                                numeros = "1234567890";
                                especiales = "8-37-39-46";

                                tecla_especial = false
                                for(var i in especiales){
                                    if(key == especiales[i]){
                                        tecla_especial = true;
                                        break;
                                    }
                                }

                                if(numeros.indexOf(tecla)==-1 && !tecla_especial){
                                    return false;
                                }
                            }
                        </script>

                        <script>
                            function soloLetras(e){
                                key = e.keyCode || e.which;
                                tecla = String.fromCharCode(key);
                                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
                                especiales = "8-37-39-46";

                                tecla_especial = false
                                for(var i in especiales){
                                    if(key == especiales[i]){
                                        tecla_especial = true;
                                        break;
                                    }
                                }

                                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                                    return false;
                                }
                            }
                        </script>

                        <form class="form-horizontal" role="form" method="POST" action="{{url('grupos')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Codigo</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="codigoGrupo" value="{{old('codigoGrupo')}}" onkeypress="return soloNumeros(event)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Clasificacion</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="clasificacion" value="{{ old('clasificacion') }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Jornada</label>
                                <div class="col-md-6">
                                    {!! Form::select('jornada', ['Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Noche' => 'Noche'], null, [ 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Grado</label>
                                <div class="col-md-6">
                                    <select name="grado" class="form-control">
                                        @for($i=1;$i<=11;$i++)
                                            <option value = {{"$i"}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <!--<input type="number" class="form-control" name="grado" value="{{old('grado')}}" onkeypress="return soloNumeros(event)" maxlength="2">-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Institucion</label>
                                <div class="col-md-6">
                                    {!! Form::select('institucion_codigoInstitucion', $institucion, null, [ 'id' => 'institucion_codigoInstitucion', 'class' => 'form-control'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>
                                    <a class="btn btn-primary" href="{{url('grupos')}}">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection