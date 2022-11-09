
<?php  $horasDisp=arrayHoras(7, 21)?>

<h2 class="titulo">Agenda</h2>

<div class="barraAgenda">

  <a data-href="<?php echo site_url('Agenda/incluir/'.$modal);?>"
      class="abrirPagina btn btn-info btnLayout"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>
       data-target="#vermodal" title="Incluir "
       style="float:right">
  <i class="fas fa-plus"></i>
  </a>
  <div class='col-sm-1' style="float: left">
  <button class="btn btn-default btnFiltro btnLayout"
  type="button"
   data-toggle="collapse"
   data-target="#filtro"
    aria-expanded="false"
    aria-controls="collapseExample"
    style="float:left"
    >
  &#xf2f5;
  </button>
</div>
  <div class='col-sm-3' style="float: left">
  <form id="filtroData"
   data-action="<?php echo $action?>"
   data-target=".conteudo"
   modal="ok"
   aba=""
   class="filtro nelos-formulario filtroForm"
   method="post"
   style="float:left"
   >

                         <?php $atributos = array(
                            'name' => 'data',
                            'id' => 'data',
                            'class'=>'filtroAgendaData',
                            'value' => $dadosAgenda['data'],
                            'type'=>'date',
                            'placeholder'=>'data',
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>




  </form>
  </div>


<form id="addPessoa" data-action="<?php echo $action?>" data-target=".conteudo" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >
  <p>

  </p>
  <div class="collapse " id="filtro">
    <div class="filtroResponsivo">

                      <div class='col-sm-4'>
                      <?php  echo form_dropdown(
                          'id_cliente',
                          $comboCliente,
                          $dadosAgenda['id_cliente'],
                          'name="id_cliente" id="id_cliente" '); ?>
                        </div>



                      <div class='col-sm-4'>
                      <?php  echo form_dropdown(
                          'id_servico',
                          $comboServico,
                          $dadosAgenda['id_servico'],
                          'name="id_servico" id="id_servico" '); ?>
                            </div>

                         <div class='col-sm-3'>
                       <?php $atributos = array(
                          'name' => 'data',
                          'id' => 'data',
                          'value' => $dadosAgenda['data'],
                          'type'=>'date',
                          'placeholder'=>'data',
                          'required'=>'required');
                          echo form_input($atributos);
                          ?>
                        </div>



      <p class="col-sm-1">
        <button type='submit' class="btn btn-primary">
          &#xf2f5;
        </button>
      </p>
    </div>
  </div>
</form>

</div>
<div class="conteudoSked" style="  border-radius: 0px 0 0 0;">
  <?php echo  $console; ?>

<div class="corpoAgenda">


<div style="width:10%; position:relative; index:10">
  <ul class="horasAgenda">
  <?php foreach ($horasDisp as $horas){?>
    <li>
      <?php echo $horas;?>

    </li>
  <?php }?>
</ul>
</div>


<?php


foreach ($objColaborador->listar() as $profissional){?>
<div class=' agenda'>

  <i class="iconeAgenda"><i class="fas fa-fw fa-user"></i></i>

  <h1>  <?php echo $profissional['nome'];?></h1>




  <ul >
  <?php foreach ($horasDisp as $horas){?>
    <li>

      <?php
      $filtro =  array('id_profissional' =>$profissional['id'] ,
      'id_cliente'=>$dadosAgenda['id_cliente'],
      'id_servico'=>$dadosAgenda['id_servico'],
      'data'=>$dadosAgenda['data'],
    'horas' =>$horas.':00');

      $agenda=$objAgenda->filtrar($filtro);
      if(!empty($agenda)){  ?>

      <div class="agendado  <?php if($agenda[0]['status']=="pago"){ echo"pago";}?>">

        <div class="col-sm-8">

            <b><?php  echo $objServico->ver($agenda[0]['id_servico'])['nome'];?></b><br/>
            <i><b>Cliente:</b> <?php  echo $objCliente->ver($agenda[0]['id_cliente'])['nome'];?></i><br/>

        </div>
        <div class="col-sm-4">


      <!--    <a data-href="<?php echo site_url('Agenda/editar/'.$modal.'/'.$agenda[0]['id']);?>"
             class="abrirPagina btnMin"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>
              data-target="#vermodal" >&#xf2bf; </a>-->

               <?php if($agenda[0]['status']!="pago"){?>
                 
                 <a data-href="<?php echo site_url('Agenda/excluir/'.$modal.'/'.$agenda[0]['id']);?>"
                    class="excluirPadrao btnMin" data-msg="Deseja excluir ? " data-target=".conteudo" >&#xf1eb; </a>

              <a data-href="<?php echo site_url('Pagamento/incluir/'.$agenda[0]['id']);?>"
                 class="abrirPagina btnMin"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>
                  data-target="#vermodal" >&#xf316;</a>



           <?php }else{ ?>


             <small >
               PAGO</small>



         <?php

         }?>


        </div>

      </div>

        <?php }?>



    </li>
  <?php }?>
</ul>
</div>
<?php }?>


</div>
</div>
