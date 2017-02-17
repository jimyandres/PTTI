<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!--<form class="form-horizontal">-->
            <div class="form-group" id="codigotest">
                <div class="col-sm-2">
                    <label for="codigotest" class="control-label">Código Test
                        <br>
                    </label>
                </div>
                <div class="col-sm-10">
                    <textarea class="form-control" id="codigotest" name="codigotest" required></textarea>
                </div>
            </div>
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
                <div class="col-md-2 text-right">
                    <a id="btn_eliminar_pregunta" type="button" class="btn btn-danger btn-sm col-md-12" onclick="return confirm('¿Seguro que deseas eliminarla?')">Eliminar pregunta</a>
                    <!--<a class="btn btn-danger btn-sm col-md-12">Eliminar pregunta seleccionada</a>-->
                </div>
            </div>
        </div>
        <button id="btn_agregar" type="button" class="btn btn-success btn-add">+</button>
        <p></p>
    </div>
</div>