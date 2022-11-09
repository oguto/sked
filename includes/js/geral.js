$(function() {

    const LINK_MENU =".nav-link";

    const LINK_SUB_MENU =".sub-menu a";

    const LI_MENU =".nav-item";

    const CLICK ="click touchstart";

    const CONTEUDO =".conteudo";

    const ID_BODY ="#MyBody";

    const ID_BODY_MODAL = "#bodyModal"

    const TELA_PRINCIPAL ='#telaPrincipal';

    const PRELOAD= "<p class='carregando'></p>";

    const chosenWidth="99.9%" ;

    // MENU PRINCIPAL

    $(document).on(CLICK,LINK_MENU,function() {

        var link = $(this).attr('data-href');

        var conf = $(this).attr('data-conf');

        if(link){

            $(CONTEUDO).html(PRELOAD);

            $(CONTEUDO).load(link,function(data){

              $("#menu_tansacao").removeClass("show");

              $('select').chosen({width: chosenWidth});

                var href= $('.menu-vertical>li.active>a').attr('data-href');

                if(typeof href != 'undefined'){


                    $(TELA_PRINCIPAL).html(PRELOAD);

                    $(TELA_PRINCIPAL).load(href,function(){

                       $('select').chosen({width: chosenWidth});
                   });

                    $('select').chosen({width: chosenWidth});


                }

                if(typeof conf != 'undefined'){

                    $(TELA_PRINCIPAL).html(PRELOAD);

                    $(TELA_PRINCIPAL).load(conf,function(data){

                        $('select').chosen({width: chosenWidth});

                    });
                }


            });
        }

    });

    $(document).on(CLICK, LINK_SUB_MENU, function() {

        var link = $(this).attr('data-href');

        var home = $(this).attr('data-home');

        var tab = $(this).attr('data-tab');

        $("#menu_tansacao").removeClass("show");

        if(home){

            $(CONTEUDO).html(PRELOAD);

            $(CONTEUDO).load(home,function(data){

                $('select').chosen({width: chosenWidth});

                if(typeof link != 'undefined'){

                    $(TELA_PRINCIPAL).html(PRELOAD);

                    $(TELA_PRINCIPAL).load(link,function(){

                    $('select').chosen({width: chosenWidth});

                   });

                    $('select').chosen({width: chosenWidth});

                }

                if(typeof tab != 'undefined'){

                    $(ID_BODY+" .nav li").removeClass("active");

                    $(ID_BODY+" .nav li:nth-child("+tab+")").addClass("active");

                }

                $("html, body").animate({ scrollTop: 0 }, "slow");


            });
        }

    });

    $(document).on(CLICK, LI_MENU, function() {

        $(LI_MENU).removeClass('active');

        $(this).addClass('active');

    });

    $(document).on(CLICK, ".nav-tabs li", function() {

        $(".nav-tabs li").removeClass('active');

        $(this).addClass('active');

    });

    $('.summernote').summernote({
      airMode: true
    });


    $(document).on(CLICK, '  .dias p', function() {

        $(this).popover({html:true});

        $(this).popover('toggle');
    });

    $.validator.setDefaults({ ignore: ":hidden:not(select)" });

    $('form').validate({
        rules: { chosen: "required"},
        messages: { required: "*" }
    });



    function chosenNelos(){

     $('.summernote').summernote();

     $('select.selectUm').chosen({
        width: "99.9%",
        allow_single_deselect:false,
        display_selected_options:false,
        max_selected_options:1
    });

     $('select').chosen({
        width: "99.9%",
        allow_single_deselect:false,
        display_selected_options:false,
        placeholder_text_multiple:"Selecione..."
    });

     $('form').validate({ ignore: ":hidden:not(select)" });

 }

    function botaoVoltar(url,urlInicio){

          var inicio = $(".visualizar").attr("url-inicio");

          if(url){

              $(".vermodal ul.nav li h3").prepend("<a class='btn-voltar' url='"+url+"'>&#xf124; Voltar<a/>");

          }

      }

    //variaveis padrao
    function desabilitar(){

        $('.disabilitar').attr("disabled","disabled");

        $('.disabilitar input').attr("disabled","disabled");

        $('.disabilitar textarea').attr("disabled","disabled");

        $('.disabilitar select').attr("disabled","disabled");

        $('.disabilitar button[type="submit"]').hide();

    }



    //METODO VOLTAR PARA MODAL

      $(document).on(CLICK, ' .vermodal a.btn-voltar', function() {

          var url = $(this).attr("url");

          if(url!="#"){

              $(ID_BODY_MODAL).html(PRELOAD);

              $(ID_BODY_MODAL).load(url,function(){

                  chosenNelos();

                  desabilitar();


              });

          }

      });


      $(document).on(CLICK, '.abrirPagina', function() {

          var url = $(this).attr("data-href");

          var urlVoltar = $(this).attr("url-voltar");

          var urlInicio = $(".visualizar").attr("url-inicio");

          if(url!="#"){

              $(ID_BODY_MODAL).html(PRELOAD);

              $(ID_BODY_MODAL).load(url,function(){

                  chosenNelos();

                  desabilitar();

                  botaoVoltar(urlVoltar,urlInicio);


              });

          }

      });


      $(document).on(CLICK, '.closeOpen', function() {

          var destino = $(this).attr('data-href');

          var status=$(destino).hasClass('fechado');

          if(status==true){

              $(destino).removeClass('fechado');
          }

          if(status==false){

              $(destino).addClass('fechado');
          }

      });

      $(document).on('mouseover', 'a', function() {

          $(this).attr("data-placement='right'");

          $(this).tooltip('show');

      });

      $(document).on(CLICK, '.icones a', function() {

          var id = $(this).attr("data-target");

          var target =".side-menu li"+id;

          $(".side-menu li").removeClass('active');

          $(target).addClass('active');

      });

      $(document).on(CLICK, '.icones a', function() {

          var link = $(this).attr('data-href');

          var conf = $(this).attr('data-conf');

          $(CONTEUDO).html(PRELOAD);

          $(CONTEUDO).load(link,function(data){

              var href= $('.menu-vertical>li.active>a').attr('data-href');

              if(typeof href != 'undefined'){


                  $(TELA_PRINCIPAL).html(PRELOAD);

                  $(TELA_PRINCIPAL).load(href,function(){

                     $('select').chosen({width: chosenWidth});
                 });

                  $('select').chosen({width: chosenWidth});


              }

              if(typeof conf != 'undefined'){

                  $(TELA_PRINCIPAL).html(PRELOAD);

                  $(TELA_PRINCIPAL).load(conf,function(data){

                      $('select').chosen({width: chosenWidth});

                  });
              }


          });

      });

      $(document).on(CLICK, '.loadModulo', function() {

          var link = $(this).attr('data-href');

          var conf = $(this).attr('data-conf');


          var active = $(this).attr('data-active');

          $(CONTEUDO).html(PRELOAD);

          $(CONTEUDO).load(link,function(data){


            $(".side-menu li").removeClass('active');

            $(active).addClass('active');

            var href= $('.menu-vertical>li.active>a').attr('data-href');

            if(typeof href != 'undefined'){


              $(TELA_PRINCIPAL).html(PRELOAD);

              $(TELA_PRINCIPAL).load(href,function(){

                 $('select').chosen({width: chosenWidth});
             });

              $('select').chosen({width: chosenWidth});


          }

          if(typeof conf != 'undefined'){

              $(TELA_PRINCIPAL).html(PRELOAD);

              $(TELA_PRINCIPAL).load(conf,function(data){

                  $('select').chosen({width: chosenWidth});

              });
          }

          $("html, body,div.modal").animate({ scrollTop: 0 }, "slow");


      });

      });

    //Rotina para carregamento com destino específico
    $(document).on(CLICK, '.loadTarget', function() {

        var url = $(this).attr("data-href");

        var target = $(this).attr("data-target");

        $(target+" div.console").html(PRELOAD);

        $(target).load(url,function(){

          $('select').chosen({width: chosenWidth});


      });

    });

    $(document).on(CLICK, '.loadTargetPaginacao', function() {

        var url = $(this).attr("data-href");

        var filtro = $(this).attr("filtro");

        var destino = $(this).attr("destino");

        if (filtro != null) {

            url = url + "/?" + filtro;
        }

        $(destino).html(PRELOAD);

        $(destino).load(url);

    });

    //Rotinna para envio de formulário

    $(document).on('submit', '.enviaform', function() {

        var action = $(this).attr("data-action");

        var ativa = $(this).attr("bloqueio");

        var destino = $(this).attr("destino");

        var atualiza = $(this).attr("load");

        var modal = $(this).attr("modal");


        if (modal =="false") {

            $('#vermodal').modal('hide');

            $(atualiza+' div.console').html(PRELOAD);

        }

        /* if (ativa != "true") {

            $(this).find(':submit').attr('disabled', 'disabled');

        }*/

        $.post(action, $(this).serialize(), function(data) {

            if (data != null) {

                $(ID_BODY_MODAL).html(data);

                $('select').chosen({width: chosenWidth});

                $(atualiza).load(destino,function(){

                 $('select').chosen({width: chosenWidth});
             });

            }

            $("html, body,div.modal").animate({ scrollTop: 0 }, "slow");
        });



        return false;



    });

    $(document).on('submit', '.enviarFile', function() {

        var upload = $(this).attr("upload");

        var action = $(this).attr("url");

        var destino = $(this).attr("destino");

        var atualiza = $(this).attr("load");

        var dados = $(this).serializeArray();

        var arquivo = $(':file');

        $.post(action, $(this).serialize(), function(data) {

            upload = upload+"/"+dados[2].value;

            $(atualiza).html(PRELOAD);

            $.ajaxUploadPost(upload,arquivo,function(r){

                console.log(atualiza);

                $(atualiza).load(destino,function(){

                    $('select').chosen({width: chosenWidth});


                });


            });

        });

        return false;

    });

    $(document).on('change', '.enviarFile input[name="arquivo"]', function() {

        console.log($(this).val());

        $('input[name="arquivo_form"]').val($(this).val());

        ;

    });

    $(document).on('change', '.filtroAgendaData', function() {

        var target = $("#filtroData").attr('data-target');

        var action = $("#filtroData").attr('data-action');

        $.post(action, {data:$(this).val()}, function(data) {

            if (data != null) {

                $(target).html(data);


            }

        });

    });

    $(document).on('submit', '.filtroForm', function() {

        var action = $(this).attr("data-action");

        var target = $(this).attr("data-target");

        //$(".filtroForm>button").removeAttr("type");

        $(target+' div.console').html(PRELOAD);

        $.post(action, $(this).serialize(), function(data) {

            if (data != null) {

                $(target).html(data);

                $('select').chosen({width: chosenWidth});


            }

        });

        return false;

    });

    $(document).on('submit', '.dataForm', function() {
        $(this).find(':submit').attr('disabled', 'disabled');

        var action = $(this).attr("data-action");

        var atualiza = $(this).attr("load");

        $(atualiza).html(PRELOAD);

        $.post(action, $(this).serialize(), function(data) {

            $(atualiza).html(data);

            $('select').chosen({width: chosenWidth});

        });

        return false;
    });

    $(document).on('change', '.optionDinamico', function() {

        var url = $(this).attr('data-url');

        var target = $(this).attr('data-target');

        var referencia=  $(this).attr('id');

        referencia = "#"+referencia;

        $(referencia+" option:selected").each(function() {

            var id = $(this).attr("value");

            url =url+"/"+id;

            $.get(url).done(function(data){

                var  option ;

                dataObj=JSON.parse(data);

                $.each(dataObj, function(attr, item) {

                    option= option+"<option value="+attr+" >"+item+"</option>";

                });

                $(target).html(option).promise().done(function(){

                    console.log("ok");

                    $(target).trigger("chosen:updated");


                });



            });


        });

    });

    $(document).on('change', '.comboDinamico', function() {

        var url = $(this).attr('data-url');

        var target = $(this).attr('data-target');

        var referencia=  $(this).attr('id');

        referencia = "#"+referencia;

        $(referencia+" option:selected").each(function() {

            var id = $(this).attr("value");

            url =url+"/"+id;

            $(target).load(url,function(){

             $('select').chosen({width: chosenWidth});

         });


        });

    });

    $(document).on('change', '.comboViaPost', function() {

        var url = $(this).attr('data-url');

        var target = $(this).attr('data-target');

        var referencia=  $(this).attr('id');

        var campo=  $(this).attr('name');

        referencia = "#"+referencia;

        $(referencia+" option:selected").each(function() {

            var valor = $(this).attr("value");

            if(valor){

            var busca ='{"'+campo+'":'+valor+'}';

            var busca =JSON.parse(busca);
          }else{

            var busca ={};

          }

            $.post(url,busca, function(data) {

                if (data != null) {

                    $(target).html(data);

                    $('select').chosen({width: chosenWidth});


                }

            });




        });

    });

    $(document).on('change', '.comboMenu', function() {

        var target = $(this).attr('data-target');

        $(".comboMenu option:selected").each(function() {

            var url = $(".comboMenu option:selected").attr("value");
            console.log(url);

            $(target).load(url,function(){

             $('select').chosen({width: chosenWidth});

         });


        });

    });

    $(document).on('change', '.selectDinamc', function() {
        $("select option:selected").each(function() {
            var add = $(this).attr("add");
            if (add != null) {
                var addHtml = $(add + ">div").clone();
                $(".comboDinamic").html(addHtml);
            }
        });

    });

    //Abaixo a rotina para exclusão do sistema

    $(document).on(CLICK, '.ativarAnoLetivo', function() {

        var msg = $(this).attr("data-msg");
        var url = $(this).attr("data-href");
        var target = $(this).attr("data-target");


        swal({
          title: msg,
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim",
          cancelButtonText:"Não",
          closeOnConfirm: true
      },
      function(){
         $(target+' div.console').html(PRELOAD);

         $(target).load(url,function(){

            $('select').chosen({width: chosenWidth});

            document.location.reload();
        });
     });


    });

    // Rotina para carregamento de html com estilo "Colapsso"

    $(document).on(CLICK, '.mostraForm', function() {
        var url = $(this).attr("data-href");
        var target = $(this).attr("target");
        var seclass = $(this).hasClass('collapsed');

        if (seclass == false) {
            $(target).load(url,function(){

              $('select').chosen({width: chosenWidth});
          });
        } else {
            $(target).html("");
        }

    });

    $(document).on(CLICK, 'input[name=data_frequencia]', function() {

        $(this).datepicker({format: "dd/mm/yyyy"});
        $(this).datepicker('show');

    });

    $(document).on(CLICK, '#filtrar_materia_professor', function() {

        var action = $(this).attr('data-url');

        var data = $("#data_frequencia").val();

        var id_turma = $('#id_turma_frequencia').val();

        var objPost={data:data,id_turma:id_turma}  ;

        $.post(action, objPost, function(data){

            var  option ;

            dataObj=JSON.parse(data);

            $.each(dataObj, function(attr, item) {

                option= option+"<option value="+attr+" >"+item+"</option>";

            });

            $('.gerarFrequencia').html(option);

            $('.gerarFrequencia').trigger("chosen:updated");

            gerarFrequencia();

        });


    });

    $(document).on('submit', '.dataFormFrequencia', function() {

        $(this).find(':submit').attr('disabled', 'disabled');

        var action = $(this).attr("data-action");

        var atualiza = $(this).attr("load");

        $(atualiza).html(PRELOAD);

        $.post(action, $(this).serialize(), function(data) {

            $(atualiza).html(data);

            $('select').chosen({width: chosenWidth});

            gerarFrequencia();

        });

        return false;
    });

    $(document).on(CLICK, '.excluirPadrao', function() {

        var msg = $(this).attr("data-msg");

        var url = $(this).attr("data-href");

        var target = $(this).attr("data-target");

        var modal = $(this).attr("modal");


        swal({
          title: msg,
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim",
          cancelButtonText:"Não",
          closeOnConfirm: true
      },
      function(){
         $(target+' div.console').html(PRELOAD);

         $(target).load(url,function(){

            $('select').chosen({width: chosenWidth});

            if(modal=="hide"){

                $('#vermodal').modal('hide');

            }
        });
     });


    });

    $(document).on('submit', '.excluirEmMassa', function() {


        $(this).find(':submit').attr('disabled', 'disabled');

        var msg = $('.AcaoEmMassa').attr("data-msg");

        var url = $('.AcaoEmMassa').attr("data-url");

        var target = $('.AcaoEmMassa').attr("data-target");

        var dados =$(this).serialize();

        swal({
          title: msg,
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim",
          cancelButtonText:"Não",
          closeOnConfirm: true
      },
      function(){
         $.post(url,dados,function(data) {

            $(target).html(data);

            $('select').chosen({width: chosenWidth});

            selecionados();

        });
     });

        return false;


    });


    $(document).on('change', '.gerarFrequencia', function() {

        gerarFrequencia();

    });

    $(document).on(CLICK,'#marcarTodos',function(){
        $('table > tbody > tr > td > :checkbox')
        .attr('checked', $(this).is(':checked'))
        .trigger('change');

        selecionados();

    });

    $(document).on(CLICK,'input[name="selecionado[]"]',function(){
        $(this)
        .attr('checked', $(this).is(':checked'))
        .trigger('change');

        selecionados();

    });

    $('table > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
    });


    function selecionados() {
        var total = 0;
        var htmlSelect="";
        var chklista = $('input[name="selecionado[]"]:checked').toArray().map(function(check) {

            total++;

            htmlSelect= htmlSelect+"<input type='hidden' name='selecionado[]' value="+$(check).val()+">";

        });

        var html = "<form class='excluirEmMassa' method='post'>"+ htmlSelect+
        " <button type='submit' class=' btn btn-danger' style='float:left'>Excluir ("+total+")</button>"+
        "</form>";

        $('form.excluirEmMassa').remove();
        if(total>0){

            $('.AcaoEmMassa tbody > tr > td:last').append(html);

        }

    }




    $('.corpoAgenda').each(function() {

  const group = 3; // group 3 by 3
  const $items = $(this).find('div.agenda');
  const $btns = $(this).find('.prev, .next');
  const max = Math.ceil($items.length / group);
  let c = 0;

  function showItems(ev) {
    c = c<0 ? max-1 : c%max;
    $items.hide().slice(group*c, group*c+group).show();
  }

  $btns.on('click', function() {
    $(this).is('.next') ? ++c : --c;
    showItems();
  });

  showItems(); // init
});



});







//ROTINA ESPECIFICA PARA GERAR FREQUENCIA
