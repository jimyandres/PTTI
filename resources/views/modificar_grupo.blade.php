<div class="form-group">
    <label class="col-md-4 control-label">Codigo</label>
    <div class="col-md-6">
        <input id="codigoGrupo" type="number" class="form-control" name="codigoGrupo" value="{{old('codigoGrupo')}}" onkeypress="return soloNumeros(event)">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Clasificacion</label>
    <div class="col-md-6">
        <input id="clasificacion" type="text" class="form-control" name="clasificacion" value="{{ old('clasificacion') }}" >
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Jornada</label>
    <div class="col-md-6">
        {!! Form::select('jornada', ['Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Noche' => 'Noche'], null, ['id' => 'jornada', 'class' => 'form-control'])!!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Grado</label>
    <div class="col-md-6">
        <select id="grado" name="grado" class="form-control">
            @for($i=1;$i<=11;$i++)
                <option value = {{"$i"}}>{{ $i }}</option>
            @endfor
        </select>
    <!--<input type="number" class="form-control" name="grado" value="{{old('grado')}}" onkeypress="return soloNumeros(event)" maxlength="2">-->
    </div>
</div>

<div class="form-group hidden">
    <label class="col-md-4 control-label">Clasificacion</label>
    <div class="col-md-6">
        <input id="psicologo_old" type="text" class="form-control" name="psicologo_old" >
    </div>
</div>

<div class="form-group hidden">
    <label class="col-md-4 control-label">Cambiar Psicologo</label>
    <div class="col-md-6">
        <input id="cambiar_psicologo" type="text" class="form-control" name="cambiar_psicologo" >
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Psicologo</label>
    <div class="col-md-6">
        <!--<input id="psicologo" type="text" class="form-control" name="psicologo" >-->
        {!! Form::select('psicologo', $psicologos_all, null, [ 'id' => 'psicologo', 'class' => 'form-control'])!!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Institucion</label>
    <div class="col-md-6">
        {!! Form::select('institucion_codigoInstitucion', $institucion, null, [ 'id' => 'institucion_codigoInstitucion', 'class' => 'form-control'])!!}
    </div>
</div>