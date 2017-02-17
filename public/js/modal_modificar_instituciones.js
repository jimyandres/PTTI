$("#edit").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nombre = button.data('nombre');
    var direccion = button.data('direccion');
    var telefono = button.data('telefono');
    var sitioweb = button.data('sitioweb');
    var ciudad = button.data('ciudad');

    $("#edit").find(".modal-body #codigoInstitucion").val(id);
    $("#edit").find(".modal-body #nombre").val(nombre);
    $("#edit").find(".modal-body #direccion").val(direccion);
    $("#edit").find(".modal-body #telefono").val(telefono);
    $("#edit").find(".modal-body #sitioWeb").val(sitioweb);
    $("#edit").find(".modal-body #ciudad").val(ciudad);
    $("#modificarInstitucion").attr('action', `/instituciones/modificar/${id}`);
});
