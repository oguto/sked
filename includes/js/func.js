$.fn.optionsCombo = function(selectOrigen, selectDestino) {
    var url = $(selectOrigen).attr('url');

        $(selectOrigen+"option:selected").each(function() {

            var id = $(this).attr("value");

            if (id != null) {

                $(selectDestino).load(url + id);

            }
        });


}

function configurar() {
    $('select').chosen();

    alert('123');


}
