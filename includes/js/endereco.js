$(function() {

      seleciona = function(selectOrigen, selectDestino) {
        var url = $(selectOrigen).attr('data-url');

            $(selectOrigen+" option:selected").each(function() {

                var id = $(this).val();

              


                if (id != null) {                

                        $(selectDestino).load(url + id,function(){

                             $(selectDestino).trigger("chosen:updated");

                        });
                                     
                }
                
            });


    }

    $(document).on('change', 'select#estado', function() {

       seleciona("select#estado","select#cidade");
      

    });
 });