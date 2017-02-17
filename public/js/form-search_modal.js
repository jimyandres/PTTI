$("#asignar_test").on('show.bs.modal', function() {
    $(this).find(".search").keyup(function () {
        var searchTerm = $(this).find(".search").val();
        var listItem = $(this).find('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });

        $(this).find(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
        });

        $(this).find(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
        });

        var jobCount = $(this).find('.results tbody tr[visible="true"]').length;
        $(this).find('.counter').text(jobCount + ' item');

        if(jobCount == '0') {$(this).find('.no-result').show();}
        else {$(this).find('.no-result').hide();}
    });
});