$("#visualizar").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nombre = button.data('nombre');
    var apellido = button.data('apellido');
    var email = button.data('email');
    var tipodocumento = button.data('tipodocumento');
    var fechanacimiento = button.data('fechanacimiento');
    var password = button.data('password');
    var genero = button.data('genero');
    var telefono = button.data('telefono');
    var institucion = button.data('institucion');
    var grupo = button.data('grupo');
    var usuario = button.data('usuario');

    $("#visualizar").find(".modal-body #id").val(id).attr('readonly', true);
    $("#visualizar").find(".modal-body #name").val(nombre).attr('readonly', true);
    $("#visualizar").find(".modal-body #apellido").val(apellido).attr('readonly', true);
    $("#visualizar").find(".modal-body #email").val(email).attr('readonly', true);
    $("#visualizar").find(".modal-body select#tipoDocumento").val(tipodocumento).attr('selected', 'selected').attr('readonly', true);
    //$('.modal-body #tipoDocumento > option[value=CT]').attr('selected', 'selected');
    //Doc.val(button.data('tipoDocumento')).attr('selected', 'selected');
    //$("#edit").find(".modal-body #tipoDocumento").val(tipoDocumento).attr('selected', 'selected');// > option[value=tipoDocumento];
    $("#visualizar").find(".modal-body #fechaNacimiento").val(fechanacimiento).attr('readonly', true);
    $("#visualizar").find(".modal-body #password").val(password).attr('readonly', true);
    //$("#edit").find(".modal-body #genero").val(genero);
    $("#visualizar").find(".modal-body select#genero").val(genero).attr('readonly', true);
    $("#visualizar").find(".modal-body #telefono").val(telefono).attr('readonly', true);
    $("#visualizar").find(".modal-body select#institucion_codigoInstitucion").val(institucion).attr('readonly', true);
    $("#visualizar").find(".modal-body #grupo_codigoGrupo").val(grupo).attr('readonly', true);
    $("#visualizar").find(".modal-body select#tipoUsuario_codigoTipoUsuario").val(usuario).attr('selected', 'selected').attr('readonly', true);

    $("#aceptar").on('click', function () {
        //$("#aceptar").attr('href', `/solicitudes/aceptar/${id}`);
        $("#responderSolicitud").attr('action', '/solicitudes/aceptar');
    });

    $("#rechazar").on('click', function () {
        //$("#rechazar").attr('href', `/solicitudes/rechazar/${id}`);
        $("#responderSolicitud").attr('action', '/solicitudes/rechazar');
    });
});
