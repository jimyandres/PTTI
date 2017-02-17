<div class="form-group">
    <label class="col-md-4 control-label">NIT</label>
    <div class="col-md-6">
        <input id="codigoInstitucion" type="number" class="form-control" name="codigoInstitucion" value="{{old('codigoInstitucion')}}" onkeypress="return soloNumeros(event)">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" onkeypress="return soloLetras(event)">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Direccion</label>
    <div class="col-md-6">
        <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Telefono</label>
    <div class="col-md-6">
        {!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '7'])!!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Sitio Web</label>
    <div class="col-md-6">
        <input id="sitioWeb" type="text" class="form-control" name="sitioWeb" value="{{old('sitioWeb')}}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Ciudad</label>
    <div class="col-md-6">
        <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" onkeypress="return soloLetras(event)">
    </div>
</div>