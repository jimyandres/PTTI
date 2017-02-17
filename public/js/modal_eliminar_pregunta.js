$("#eliminar").on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var codigoPregunta = button.data('codigopregunta');

    $(this).find(".modal-body #pregunta").val(codigoPregunta);
    //window.open(pregunta_eliminar);
    $("#eliminarPregunta").attr('action', `/test/eliminar_pregunta`);
});

$("#eliminar").on('hide.bs.modal', function () {
    //$(this).find(".modal-body #pregunta").attr('disabled', false);
    $(this).find(".modal-body #pregunta").val('');
    //$(this).find(".modal-body #pregunta").attr('disabled', true);

});
