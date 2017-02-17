$("#edit").find(".modal-body select#psicologo").append(`<option value=""></option>`);
$("#edit").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var clasificacion = button.data('clasificacion');
    var jornada = button.data('jornada');
    var grado = button.data('grado');
    var institucion = button.data('institucion');
    var psicologo = button.data('psicologo');

    $("#edit").find(".modal-body select#psicologo").change(event => {
        $("#edit").find(".modal-body #cambiar_psicologo").val('si');
    });

    $("#edit").find(".modal-body #cambiar_psicologo").val('no');
    $("#edit").find(".modal-body #codigoGrupo").val(id);
    $("#edit").find(".modal-body #clasificacion").val(clasificacion);
    $("#edit").find(".modal-body #psicologo_old").val(psicologo);
    $("#edit").find(".modal-body select#jornada").val(jornada).attr('selected', 'selected');
    $("#edit").find(".modal-body select#grado").val(grado).attr('selected', 'selected');
    $("#edit").find(".modal-body select#institucion_codigoInstitucion").val(institucion).attr('selected', 'selected');
    $("#edit").find(".modal-body select#psicologo").val(psicologo).attr('selected', 'selected');
    $("#modificarGrupo").attr('action', `/grupos/modificar/${id}`);
});
