/*$("#institucion_codigoInstitucion").change(event => {
    $.get(`/auth/register/${event.target.value}`, function (res, sta) {
        $("#grupo_codigoGrupo").empty();
        console.log(response);
        res.forEach(element => {
            $("#grupo_codigoGrupo").append(`<option value=${element.codigoGrupo}>${element.codigoGrupo} </option>`);
        });
    });
});*/
$("#tipoUsuario_codigoTipoUsuario").on('change', function () {
    $("#grupo_codigoGrupo").empty();
    var tipo_usuario = $(this).val();
    if (tipo_usuario != 3) {
        $("#grupo_codigoGrupo").append(`<option value=""></option>`).attr('disabled', true);
    }
    else {
        $("#grupo_codigoGrupo").append(`<option value=""></option>`).attr('disabled', false);
    }
});
$("#tipoUsuario_codigoTipoUsuario").change()

$("#institucion_codigoInstitucion").append(`<option value="" selected></option>`);
$("#institucion_codigoInstitucion").change(event => {
    $.get(`/auth/register/${event.target.value}`, function(res, sta) {
        $("#grupo_codigoGrupo").empty();
        $("#grupo_codigoGrupo").append(`<option value=""></option>`);
        res.forEach(element => {
            $("#grupo_codigoGrupo").append(`<option value=${element.codigoGrupo}>${element.codigoGrupo}</option>`);
        });
    });
});