<div class="form-group hidden">
    <label class="col-md-4 control-label">ID estudiante</label>
    <div class="col-md-6">
        <!--<input id="id" type="number" class="form-control" name="id" onkeypress="return soloNumeros(event)">-->
        {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '11', 'minlength' => '10', 'required'])!!}
    </div>
</div>

<div class="form-group hidden" id="codigotest">
    <label class="col-md-4 control-label">Código Test</label>
    <div class="col-md-6">
        <input class="form-control" id="codigotest" name="codigotest" required>
    </div>
</div>

<div class="form-group" id="codigotest">
    <label class="col-md-4 control-label">Comentario</label>
    <div class="col-md-6">
        <textarea class="form-control" id="diagnostico" name="comentario" maxlength="45"></textarea>
    </div>
</div>