    <div class="row">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label class="col-md-4 control-label">ID</label>
            <div class="col-md-6">
                <!--<input id="id" type="number" class="form-control" name="id" onkeypress="return soloNumeros(event)">-->
                {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '11', 'minlength' => '10'])!!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" onkeypress="return soloLetras(event)">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Apellido</label>
            <div class="col-md-6">
                <input id="apellido" type="text" class="form-control" name="apellido" onkeypress="return soloLetras(event)">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">E-Mail Address</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Tipo de Documento</label>
            <div class="col-md-6">
                {!! Form::select('tipoDocumento', ['CC' => 'CC','TI' => 'TI'], null, ['id' => 'tipoDocumento', 'class' => 'form-control'])!!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Fecha de nacimiento</label>
            <div class="col-md-6">
                {!! Form::date('fechaNacimiento', \Carbon\Carbon::now(), ['id' => 'fechaNacimiento', 'class' => 'form-control'])!!}
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
                {!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'onkeypress' => 'return soloNumeros(event)', 'maxlength' => '7', 'value' => ''])!!}
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
                <!--<select id="grupo_CodigoGrupo" class="form-control" >
                </select>-->
                {!! Form::select('grupo_codigoGrupo', ['Placeholder' => ''], null, ['id' => 'grupo_codigoGrupo', 'class' => 'form-control'])!!}

            </div>
        </div>

        <div class="form-group hidden">
            <label class="col-md-4 control-label">Tipo de usuario</label>
            <div class="col-md-6">
                {!! Form::select('tipoUsuario_codigoTipoUsuario', [ '1' => 'Administrador', '2' => 'Psicologo', '3' => 'Estudiante'], null, ['id' => 'tipoUsuario_codigoTipoUsuario', 'class' => 'form-control'])!!}
            </div>
        </div>
                <!--<button type="submit" class="btn btn-primary">
                    Ingresar
                </button>-->
    </div>