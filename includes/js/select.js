$(function() {

    optionsCombo = function(selectOrigen, selectDestino) {
        var url = $(selectOrigen).attr('url');

            $(selectOrigen+" option:selected").each(function() {

                var id = $(this).attr("value");

                var id2 = $(this).attr("valueb");


                if (id != null) {

                    if(id2!=null){

                        $(selectDestino).load(url + id+"/"+id2);

                    }else{

                        $(selectDestino).load(url + id);

                    }                    
                }
                
            });


    }



    //LOAD ESTADO CIVIL

    $(document).on('change', 'select#sexo', function() {

        optionsCombo("select#sexo","select#estado_civil");

    });

    //LOAD SERIE

    $(document).on('change', 'select#id_serie_nivel', function() {

        optionsCombo("select#id_serie_nivel","select#id_serie");

    });

    $(document).on('change', 'select#id_serie', function() {

        optionsCombo("select#id_serie","select#id_turno");

    });

    $(document).on('change', 'select#id_turno', function() {

        optionsCombo("select#id_turno","select#id_turma");

    });


});