$("#institucion_codigoInstitucion").append(`<option value=""></option>`);
//$("#edit").on('loaded.bs.modal', function (event) {
    //$("#edit").find(".modal-body select#grupo_codigoGrupo").val(data('grupo')).attr('selected', 'selected');
    $("#institucion_codigoInstitucion").change(event => {
        $.get(`/usuarios/ingresar/${event.target.value}`, function (res, sta) {

            $("#grupo_codigoGrupo").empty();
            $("#grupo_codigoGrupo").append(`<option value=""></option>`);
            res.forEach(element => {
                $("#grupo_codigoGrupo").append(`<option value=${element.codigoGrupo}>${element.codigoGrupo}</option>`);
            });
        });
    });
//});