$("#asignar_test").on('show.bs.modal', function(){
    $("#mytableTest #checkall").click(function () {
        if ($("#mytableTest #checkall").is(':checked')) {
            $("#mytableTest input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytableTest input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    $("[data-toggle=tooltip]").tooltip();
});
