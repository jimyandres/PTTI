(function ($) {
    $(function () {
        var $numero_preguntas = 1;

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
            $formGroupClone.find('button').removeAttr('data-id');

            /*$formGroupClone.find('select').select2({
                    placeholder: "Preguntas existentes",
                    allowClear: true
            });*/

            /*$formGroupClone.find("select#preguntas_existentes").select2({
                style: "width: 137px",
                placeholder: "Preguntas existentes",
                allowClear: true,
            });
            $formGroupClone.find('select2:last').remove();*/

            $formGroupClone.insertAfter($formGroup);
            $numero_preguntas = $numero_preguntas + 1;

            function initializeSelect2(selectElementObj) {
                selectElementObj.select2({
                    style: "auto",
                    placeholder: "Preguntas existentes",
                    allowClear: true
                });
            }

            //onload: call the above function
            $(".select-to-select2").each(function() {
                initializeSelect2($(this));
            });

            /*$("#eliminar_pregunta").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var pregunta_eliminar = button.data('id');

                $("#eliminar_pregunta").find(".modal-body input#pregunta").val(pregunta_eliminar);
                //window.open(pregunta_eliminar);
            });*/

            $("select#preguntas_existentes").on('change', function (event) {
                var $formulario = $(this);
                $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
                if (event.target.value == '') {
                    $formulario.closest('.multiple-form-group').find('textarea#enunciado').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val('');
                    $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val('');
                    $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
                }
                else {
                    //$formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-id');
                    $.get(`/test/crear/${event.target.value}`, function (res, sta) {
                        res.forEach(element => {
                            var $opciones = element.opcionesRespuesta.split('#');
                            $formulario.closest('.multiple-form-group').find('textarea#enunciado').val(element.enunciado);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val($opciones[0]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val($opciones[1]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val($opciones[2]);
                            $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val($opciones[3]);
                            $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
                            $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").attr('data-codigoPregunta', event.target.value);
                            //$formulario.closest('.multiple-form-group').find("div#eliminar").find('.modal-body input#pregunta').val(event.target.value);
                        });
                    });
                }
                //$formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").attr('data-id', event.target.value);
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
            $numero_preguntas = $numero_preguntas - 1;
        };

        /*var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };*/

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);

        /*$(document).on('click', '.btn-sm', function () {
            var pregunta = $(this).closest(".multiple-form-group").find("select#preguntas_existentes").val();
            if (pregunta != '') {
                $(this).attr('data-id', pregunta);
            }
            //window.open(pregunta);
        });*/

        $("select#preguntas_existentes").append(`<option value="" selected></option>`);

            /*$('select#preguntas_existentes').each(function () {
                $(this).select2({
                    placeholder: "Preguntas existentes",
                    allowClear: true
                });
            });*/

        $("select#preguntas_existentes").on('change', function (event) {
            var $formulario = $(this);
            $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
            if (event.target.value == '') {
                $formulario.closest('.multiple-form-group').find('textarea#enunciado').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val('');
                $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val('');
                $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
            }
            else {
                //$formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-id');
                $.get(`/test/crear/${event.target.value}`, function (res, sta) {
                    res.forEach(element => {
                        var $opciones = element.opcionesRespuesta.split('#');
                        $formulario.closest('.multiple-form-group').find('textarea#enunciado').val(element.enunciado);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_A').val($opciones[0]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_B').val($opciones[1]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_C').val($opciones[2]);
                        $formulario.closest('.multiple-form-group').find('textarea#opcion_D').val($opciones[3]);
                        $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").removeAttr('data-codigoPregunta');
                        $formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").attr('data-codigoPregunta', event.target.value);
                        //$formulario.closest('.multiple-form-group').find("div#eliminar").find('.modal-body input#pregunta').val(event.target.value);
                    });
                });
            }
            //$formulario.closest('.multiple-form-group').find("button#btn_eliminar_pregunta").attr('data-id', event.target.value);
        });

        function initializeSelect2(selectElementObj) {
            selectElementObj.select2({
                style: "auto",
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
