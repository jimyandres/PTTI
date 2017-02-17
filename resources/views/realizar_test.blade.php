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
    <div class="panel panel-default">
        <div class="panel-heading text-center text-uppercase"><i class="fa fa-fw fa-pencil-square-o fa-lg" aria-hidden="true"></i>Responder Test</div>
        <div class="panel-body">
            @include('partials/errors')
            <form class="form-horizontal" role="form" method="POST" action="{{url('test/realizar')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" class="form-control" onkeypress="return soloNumeros(event)" maxlength="11" minlength="10" value="{{$logged_user->id}}" required>
                <input  type="hidden" class="form-control" id="codigotest" name="codigotest" value="{{$test->codigoTest}}" required>

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <!--<form class="form-horizontal">-->
                            <div class="form-group" id="descripcion">
                                <div class="col-md-2">
                                    <label for="inputEmail3" class="control-label">Descripcion
                                        <br>
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <p>{{$test->descripcion}}</p>
                                </div>
                            </div>
                            <hr>
                            <!--</form>-->
                        </div>
                    </div>

                    <?php
                        $num_preguntas = count($preguntas);
                        $i=1;
                    ?>
                    @foreach($preguntas as $pregunta)
                        <?php
                            $opciones = explode('#', $pregunta->opcionesRespuesta);
                        ?>
                        <p></p>
                        <div id="pregunta{{$i}}" class="col-md-12 input-group-md">
                            <div class="form-group hidden">
                                <div class="col-md-6">
                                    <input class="form-control" id="codigopregunta" name="codigopregunta[]" value="{{$pregunta->codigoPregunta}}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{$i}}.) {{$pregunta->enunciado}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="col-xs-12">
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control input-xs" id="respuesta_A{{$i}}" name="respuesta_A[]" value="{{old('respuesta_A.'.($i-1))}}" maxlength="1" onkeypress="return validar_numeros(event)" required onkeyup="num('respuesta_A{{$i}}','respuesta_B{{$i}}','respuesta_C{{$i}}','respuesta_D{{$i}}')">
                                        </div>
                                        <div class="col-xs-7">
                                            <label>a) {{$opciones[0]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-xs-12">
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control input-xs" id="respuesta_B{{$i}}" name="respuesta_B[]" value="{{old('respuesta_B.'.($i-1))}}"maxlength="1" onkeypress="return validar_numeros(event)" required onkeyup="num('respuesta_A{{$i}}','respuesta_B{{$i}}','respuesta_C{{$i}}','respuesta_D{{$i}}')">
                                        </div>
                                        <div class="col-xs-7">
                                            <label>b) {{$opciones[1]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-xs-12">
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control input-xs" id="respuesta_C{{$i}}" name="respuesta_C[]" value="{{old('respuesta_C.'.($i-1))}}"maxlength="1" onkeypress="return validar_numeros(event)" required onkeyup="num('respuesta_A{{$i}}','respuesta_B{{$i}}','respuesta_C{{$i}}','respuesta_D{{$i}}')">
                                        </div>
                                        <div class="col-xs-7">
                                            <label>c) {{$opciones[2]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-xs-12">
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control input-xs" id="respuesta_D{{$i}}" name="respuesta_D[]" value="{{old('respuesta_D.'.($i-1))}}" maxlength="1" onkeypress="return validar_numeros(event)" required onkeyup="num('respuesta_A{{$i}}','respuesta_B{{$i}}','respuesta_C{{$i}}','respuesta_D{{$i}}')">
                                        </div>
                                        <div class="col-xs-7">
                                            <label>d) {{$opciones[3]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <?php $i++; ?>
                    @endforeach
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button id="enviar" type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function validar_numeros(e) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla==8 || tecla==0 || tecla==9)
                return true; // 3 Tecla de retroceso (para poder borrar)
            patron =/[1-4]/; // 4
            te = String.fromCharCode(tecla); // 5

            return patron.test(te); // 6
        }

        function num(a1,b1,c1,d1){

            var a=document.getElementById(a1).value;
            var b=document.getElementById(b1).value;
            var c=document.getElementById(c1).value;
            var d=document.getElementById(d1).value;
            //alert (a);
            if (a!=''){
                if ((a==b)|| (a==c) || (a==d) ){
                    //$(document).find("button#enviar").attr('disabled', true);
                    alert ("Escribe del 1 al 4 sin repetir valores en cada pregunta");
                    a.focus();
                    //return false;
                }
                else {
                    //$(document).find("button#enviar").attr('disabled', false);
                }
            }

            if (b!=''){
                if ((b==c)|| (b==d)){
                    //$(document).find("button#enviar").attr('disabled', true);
                    alert ("Escribe del 1 al 4 sin repetir valores en cada pregunta");
                    b.focus();
                    //return false;
                }
                else {
                    //$(document).find("button#enviar").attr('disabled', false);
                }
            }

            if (c!=''){
                if  (c==d){
                    //$(document).find("button#enviar").attr('disabled', true);
                    alert ("Escribe del 1 al 4 sin repetir valores en cada pregunta");
                    c.focus();
                    //return false;
                }
                else {
                    //$(document).find("button#enviar").attr('disabled', false);
                }
            }

        }
    </script>
@endsection