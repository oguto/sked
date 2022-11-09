$(function() {

    window.calcularTotal=  function() {

   var total=0.0;

   var lista=[];


    $('.enviarFormPagamento .valorServ').each(function( index ) {


        lista.push({total:$( this ).val(),deconto:0});



    });

    $('.enviarFormPagamento .descontoServ').each(function( index ) {

        lista[index].desconto=parseInt($(this).val());

    });



    lista.forEach(function(valores){

      desconto= valores.total*(1-(valores.desconto/100));

      total = total +desconto;

      console.log(total);

      });



    $("#valorTotal ").val(total);

}

    //variaveis padrao

    var chosenWidth= "99.9%";

    $(document).on('change', '#clienteCombo>select', function() {

        var action =  $('#clienteCombo').attr("url");

        var arrayCliente = [];

        $("#clienteCombo>select option:selected").each(function() {

            var id = $(this).attr("value");

            $.post(action, {id_cliente:id}, function(data) {

              $("#targetComboRota").html(data);

             $("#targetComboRota>select").trigger("chosen:updated");

            $("#targetComboRota>select").chosen({width: chosenWidth});

          });

        });

     });

    $(document).on('change', '#targetComboRota>select', function() {

        var action =  $('#targetComboRota').attr("url");

        var element = $(this).parent();


        var linha= $(element).attr("linha");

        var arrayCliente = [];

        $(".pagamentoTabela tr[linha='"+linha+"']  #targetComboRota>select option:selected").each(function() {

            var id = $(this).attr("value");

            $.post(action, {id:id}, function(data) {

              var obj=JSON.parse(data);

              $('.pagamentoTabela tr[linha="'+linha+'"] input[name="valor_cliente[]"]').val(obj.valor_cliente);



          });

        });

     });

    $(document).on('click', '.btn-pagamento', function() {

        var id_cliente = $(".enviarFormPagamento select[name='id_cliente']").val();

        linhas= $(this).attr("linha");

        var url =$(this).attr("url");

        var linha =parseInt(linhas)+1;

        console.log(linha);

        if(!id_cliente){

           alert("Selecione o cliente!");

        } else{

          var obj ={id_cliente:id_cliente,linha:linha};


        $.post(url, obj, function(data) {

          $(".btn-pagamento").attr("linha",linha);

           $("tbody.pagamentoTabela").append(data);


                $('select').chosen({
                            width: "99.9%",
                            allow_single_deselect:false,
                            display_selected_options:false,
                            placeholder_text_multiple:"Selecione..."});


        });
      }



        return false;

    });

    $(document).on('click', '.removerLinha', function() {

        var id = $(this).attr('linha');

        var linha = "tbody.pagamentoTabela tr[linha='"+id+"']";


      $(linha).remove();

        calcularTotal();




    });

    $(document).on('keyup', '.valorServ, .descontoServ', function() {
      calcularTotal();



    });

    $(document).on('change', '.filtroFim', function() {


        var url = $(".filtroFim").attr('data-url');

        var target = $(".filtroFim").attr('data-target');

        var busca ='';

        var valor_de = $(".filtroFim input#filtro_de").val();

        var  valor_ate = $(".filtroFim input#filtro_ate").val();

        if(valor_de){

          busca =busca+'"filtro_de":"'+valor_de+'"';

          if(valor_ate){

            busca=busca+",";

          }

        }

        if(valor_ate){

          busca =busca+'"filtro_ate":"'+valor_ate+'"';

          if(busca.length>1){

            busca=busca+",";

          }

        }


        $(".filtroFim select#id_colaborador option:selected").each(function() {

            var valor = $(this).val();

              if(valor_de.length>1 && valor_ate.length<1){

                busca=busca+",";

              }

              busca =busca+'"id_colaborador":"'+valor+'",';


          });

        $(".filtroFim select#id_metodo_pagamento option:selected").each(function() {

            var valor = $(this).val();

              if(valor_de.length>1 && valor_ate.length<1){

                busca=busca+",";

              }

              busca =busca+'"id_metodo_pagamento":"'+valor+'",';


          });


          $(".filtroFim select#id_servico option:selected").each(function() {

              var valor = $(this).val();

                if(valor_de.length>1 && valor_ate.length<1){

                  busca=busca+",";

                }

                busca =busca+'"id_servico":"'+valor+'"';


            });

            busca = "{"+busca+"}";

            busca =JSON.parse(busca);

            $.post(url,busca, function(data) {

                if (data != null) {

                    $(target).html(data);

                    $('select').chosen({width: chosenWidth});


                }

            });






    });

    $(document).on('change', '.filtroTrans', function() {


        var url = $(".filtroTrans").attr('data-url');

        var target = $(".filtroTrans").attr('data-target');

        var busca ='';

        var valor_de = $(".filtroTrans input#filtro_de").val();

        var  valor_ate = $(".filtroTrans input#filtro_ate").val();

        if(valor_de){

          busca =busca+'"filtro_de":"'+valor_de+'"';

          if(valor_ate){

            busca=busca+",";

          }

        }

        if(valor_ate){

          busca =busca+'"filtro_ate":"'+valor_ate+'"';

          if(busca.length>1){

            busca=busca+",";

          }

        }


        $(".filtroTrans select#id_tipo option:selected").each(function() {

            var valor = $(this).val();

              if(valor_de.length>1 && valor_ate.length<1){

                busca=busca+",";

              }

              busca =busca+'"id_tipo":"'+valor+'"';


          });

            busca = "{"+busca+"}";

            busca =JSON.parse(busca);

            $.post(url,busca, function(data) {

                if (data != null) {

                    $(target).html(data);

                    $('select').chosen({width: chosenWidth});


                }

            });






    });

    $(document).on('change', '.comboServico', function() {


        var url =  $(this).attr("data-url");

        var target =  $(this).attr("data-target");


        var id = $(this).val();

        url=url+"/"+id;

        $.get(url,function(data) {

          var servico = JSON.parse(data);

          $(target+ " .valorServ").val(servico.preco_venda);

          $(target+ " .descontoServ").attr('max',servico.desconto);

          calcularTotal();
        });



    });

    $(document).on('submit', '.enviarFormPagamento', function() {

      $(this).find(':submit').attr('disabled', 'disabled');

        var action = $(this).attr("data-action");

        var destino = $(this).attr("destino");

        var atualiza = $(this).attr("load");

        $('#vermodal').modal('hide');

        $.post(action, $(this).serialize(), function(data) {

            console.log(data);

            if (data != null) {

                $(atualiza).load(destino,function(){

                  $('select').chosen({width: chosenWidth});
               });

            }

        });

        return false;
    });



});


//ROTINA ESPECIFICA PARA GERAR FREQUENCIA
