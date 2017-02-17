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
        <div class="panel-heading text-center text-uppercase"><i class="fa fa-fw fa-file-text-o fa-lg" aria-hidden="true"></i>Crear Test de Kolb</div>
        <div class="panel-body">
            @include('partials/errors')
            <form class="form-horizontal" role="form" method="POST" action="{{url('test')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="tipotest" value="0">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!--<form class="form-horizontal">-->
                                <div class="form-group" id="descripcion">
                                    <div class="col-sm-2">
                                        <label for="inputEmail3" class="control-label">Descripcion
                                            <br>
                                        </label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="descripcion" placeholder="Descripción del test" name="descripcion" required></textarea>
                                    </div>
                                </div>
                                <hr>
                            <!--</form>-->
                        </div>
                    </div>
                    <div id="pregunta" class="multiple-form-group" data-max = 3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <!--<form class="form-horizontal" role="form">-->
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="enunciado" class="control-label">Enunciado</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <!--<input type="text" class="form-control" id="enunciado" placeholder="Enunciado" name="enunciado[]" required>-->
                                                <textarea class="form-control" id="enunciado" placeholder="Enunciado" name="enunciado[]" required></textarea>
                                            </div>
                                        </div>
                                    <!--</form>-->
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <!--<select class=" form-control" name="pregunta_existente[]" id="preguntas_existentes">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">Hola</option>
                                        </select>-->
                                        {!! Form::select('pregunta_existente[]', $preguntastest, null, ['id' => 'preguntas_existentes', 'class' => 'form-control select-to-select2'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <!--<form class="form-horizontal" role="form">-->
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Opcion A</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="opcion_A" name="opciones_a[]" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Opcion C</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="opcion_C" name="opciones_c[]" required></textarea>
                                            </div>
                                        </div>
                                    <!--</form>-->
                                </div>
                                <div class="col-md-5">
                                    <!--<form class="form-horizontal" role="form">-->
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Opcion B</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="opcion_B" name="opciones_b[]" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label for="inputEmail3" class="control-label">Opcion D</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="opcion_D" name="opciones_d[]" required></textarea>
                                            </div>
                                        </div>
                                    <!--</form>-->
                                </div>
                                <div class="col-md-2 text-center">
                                    <button id="btn_eliminar_pregunta" type="button" class="btn btn-danger btn-sm col-md-12" data-toggle="modal"
                                            data-target="#eliminar">Eliminar pregunta</button>
                                    <!--<a class="btn btn-danger btn-sm col-md-12">Eliminar pregunta seleccionada</a>-->
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-add">+</button>
                        <p></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Crear Test
                        </button>
                        <a class="btn btn-primary" href="{{url('test')}}">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section('modal-content')
        <form id="eliminarPregunta" class="form-horizontal" role="form" method="POST">
            <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Eliminar Pregunta</h4>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">ID pregunta</label>
                                <div class="col-md-6">
                                    <!--<input id="id" type="number" class="form-control" name="id" onkeypress="return soloNumeros(event)">-->
                                    <input type="text" id="pregunta" class="form-control" name="pregunta" readonly>
                                </div>
                            </div>

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> ¿Está seguro de eliminar la pregunta seleccionada?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Eliminar Pregunta</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
    @endsection

@endsection

@section('scripts')
    {!! Html::script('js/crear_test.js') !!}
    {!! Html::script('js/modal_eliminar_pregunta.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection