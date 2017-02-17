var numero_preguntas=0;

$("#edit").on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var codigoTest = button.data('codigotest');
    var descripcion = button.data('descripcion');
    var preguntas = button.data('preguntas');
    var num_preguntas = button.data('numeropreguntas');
    //numero_preguntas = num_preguntas;
    var preguntas_array = preguntas.split(',');

    $("#edit").find(".modal-body textarea#codigotest").val(codigoTest).attr('disabled', true);
    $("#edit").find(".modal-body textarea#descripcion").val(descripcion);
    //$("#edit").find(".modal-body #id").val(id);
    //$("#edit").find(".modal-body textarea#descripcion").val(preguntas);
    //$("#edit").find(".modal-body textarea#enunciado").val(num_preguntas);

    for (i=0; i<=num_preguntas-1; i++) {
        $("#edit").find(".multiple-form-group:last select#preguntas_existentes").val(preguntas_array[i]).change();

        if(i!=num_preguntas-1) {
            $("#edit").find("button#btn_agregar:last").click();
        }
        //$("#edit").find(".modal-body textarea#enunciado").val(num_preguntas);
    }

    $("#modificarTest").attr('action', `/test/modificar/${codigoTest}`);
});

$("#edit").on('hide.bs.modal', function (){
    for (i=0; i<numero_preguntas; i++) {
        $("#edit").find(".multiple-form-group:first").remove();
    }
    $("#edit").find(".multiple-form-group:last select#preguntas_existentes").val('').change();
    numero_preguntas = 0;

});

(function ($) {
    $(function () {
        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.multiple-form-group');
            //$formGroup.find(".select2").removeClass('select2');
            $formGroup.find("select#preguntas_existentes").removeClass('select2-hidden-accessible');
            $formGroup.find(".select2-container").remove();
            //$formGroup.find("select#preguntas_existentes").removeClass('select2');

            //var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-default btn-add btn-danger btn-remove')
                .html('-');

            $formGroupClone.find('input').val('');
            $formGroupClone.find('textarea').val('');
            $formGroupClone.find('select').val('');

            /*$formGroupClone.find("select#preguntas_existentes").select2({
             style: "width: 137px",
             placeholder: "Preguntas existentes",
             allowClear: true,
             });
             $formGroupClone.find('select2:last').remove();*/

            $formGroupClone.insertAfter($formGroup);
            numero_preguntas = numero_preguntas + 1;

            function initializeSelect2(selectElementObj) {
                selectElementObj.select2({
                    style: "auto",
                    tabindex: "-1",
                    placeholder: "Preguntas existentes",
                    allowClear: true
                });
            }

            //onload: call the above function
            $(".select-to-select2").each(function() {
                initializeSelect2($(this));
            });

            $("select#preguntas_existentes").on('change', function (event) {
                var $formulario = $(this);
                if (event.target.value == '') {
                    $formulario.closest('.multiple-form-group').find('textarea#enunciado').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val('');
                }
                else {
                    $.get(`/test/crear/${event.target.value}`, function (res, sta) {
                        res.forEach(element => {
                            var $opciones = element.opcionesRespuesta.split('#');
                            $formulario.closest('.multiple-form-group').find('textarea#enunciado').val(element.enunciado);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val($opciones[0]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val($opciones[1]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val($opciones[2]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val($opciones[3]);
                            $formulario.closest('.multiple-form-group').find("a#btn_eliminar_pregunta").attr('href', `test/modificar/eliminar_pregunta/${event.target.value}`);
                        });
                    });
                }
            });

            // var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            /*if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
             $lastFormGroupLast.find('.btn-add').attr('disabled', true);
             }*/
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.multiple-form-group');
            //var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            /*var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
             if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
             $lastFormGroupLast.find('.btn-add').attr('disabled', false);
             }*/

            $formGroup.remove();
            numero_preguntas = numero_preguntas - 1;
        };

        /*var countFormGroup = function ($form) {
         return $form.find('.form-group').length;
         };*/

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);

        $("select#preguntas_existentes").append(`<option value="" selected></option>`);

        $("select#preguntas_existentes").on('change', function (event) {
            var $formulario = $(this);
            if (event.target.value == '') {
                $formulario.closest('.multiple-form-group').find('textarea#enunciado').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val('');
            }
            else {
                $.get(`/test/crear/${event.target.value}`, function (res, sta) {
                    res.forEach(element => {
                        var $opciones = element.opcionesRespuesta.split('#');
                        $formulario.closest('.multiple-form-group').find('textarea#enunciado').val(element.enunciado);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val($opciones[0]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val($opciones[1]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val($opciones[2]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val($opciones[3]);
                        $formulario.closest('.multiple-form-group').find("a#btn_eliminar_pregunta").attr('href', `test/modificar/eliminar_pregunta/${event.target.value}`);
                    });
                });
            }
        });

        function initializeSelect2(selectElementObj) {
            selectElementObj.select2({
                style: "auto",
                tabindex: "-1",
                placeholder: "Preguntas existentes",
                allowClear: true
            });
        }

        //onload: call the above function
        $(".select-to-select2").each(function() {
            initializeSelect2($(this));
        });
    });
})(jQuery);


