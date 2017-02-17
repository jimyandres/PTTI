$("#edit").find(".modal-body select#institucion_codigoInstitucion").append(`<option value=""></option>`);

$("#edit").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nombre = button.data('nombre');
    var apellido = button.data('apellido');
    var email = button.data('email');
    var tipodocumento = button.data('tipodocumento');
    var fechanacimiento = button.data('fechanacimiento');
    var genero = button.data('genero');
    var telefono = button.data('telefono');
    var institucion = button.data('institucion');
    var grupo = button.data('grupo');
    var usuario = button.data('usuario');

    $("#institucion_codigoInstitucion").change(event => {
        //$("#grupo_codigoGrupo").empty();
        $.get(`/usuarios/ingresar/${event.target.value}`, function (res, sta) {
            $("#grupo_codigoGrupo").empty();
            $("#grupo_codigoGrupo").append(`<option value=""></option>`);
            res.forEach(element => {
                $("#grupo_codigoGrupo").append(`<option value=${element.codigoGrupo}>${element.codigoGrupo}</option>`);
            });
            $("#edit").find(".modal-body select#grupo_codigoGrupo").val(grupo);
        });
    });

    $("#edit").find(".modal-body #id").val(id);
    $("#edit").find(".modal-body #name").val(nombre);
    $("#edit").find(".modal-body #apellido").val(apellido);
    $("#edit").find(".modal-body #email").val(email);
    $("#edit").find(".modal-body select#tipoDocumento").val(tipodocumento).attr('selected', 'selected');
    $("#edit").find(".modal-body #fechaNacimiento").val(fechanacimiento);
    $("#edit").find(".modal-body select#genero").val(genero);
    $("#edit").find(".modal-body #telefono").val(telefono);
    $("#edit").find(".modal-body select#institucion_codigoInstitucion").val(institucion).attr('selected', 'selected').change();
    $("#edit").find(".modal-body select#tipoUsuario_codigoTipoUsuario").val(usuario).attr('selected', 'selected').change();
    if (usuario != 3) {
        $("#edit").find(".modal-body select#grupo_codigoGrupo").attr('disabled', true);
    }
    else {
        $("#edit").find(".modal-body select#grupo_codigoGrupo").attr('disabled', false);
    }
    $("#modificarUsuario").attr('action', `/usuarios/modificar/${id}`);
});