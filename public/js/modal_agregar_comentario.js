$("#comentario").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var user_id = button.data('id');
    var codigotest = button.data('codigotest');
    var comentario = button.data('comentario');

    $("#comentario").find(".modal-body #id").val(user_id).attr('disabled', true);
    $("#comentario").find(".modal-body #codigotest").val(codigotest).attr('disabled', true);
    $("#comentario").find(".modal-body textarea#diagnostico").val(comentario);

    $("#agregarComentario").attr('action', `/test/agregar_comentario/${user_id}/${codigotest}`);
});