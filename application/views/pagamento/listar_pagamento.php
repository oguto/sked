
<script src="<?php echo base_url(); ?>includes/vendor/chart.js/Chart.js"></script>
<script>

<?php
  $statusPagamento = $this->ServicoModel->filtrar();
  $listaServico=array();
  $totalPagamento=array();

  foreach ($statusPagamento as $dStatus) {


    $total = $objPagamentoServico->valorTotal(array(
      "id_servico"=>$dStatus['id'],
      "id_profissional"=>$dadosPagamentoServ['id_profissional'],
      "filtro_de"=>$dadosPagamento['filtro_de'],
      "filtro_ate"=>$dadosPagamento['filtro_ate'])
    );
    $listaServico[]=$dStatus['nome'];
    $totalPagamento[]=number_format($total[0]['valor'],2);
  }
  ?>

  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';
  Chart.defaults.global.defaultFontSize = 10;

  var ctx = document.getElementById("pgtServ");
  var pgtServ = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: <?php echo json_encode($listaServico); ?>,
      datasets: [{
        data: <?php echo json_encode($totalPagamento); ?>,
        backgroundColor: ['#4e73df', '#1cc88a', '#46b9cc', '#8e73df', '#9cc38a', '#76b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#8e73df', '#9cc38a', '#76b9cc'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 10,
        yPadding: 10,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });



</script>
<form data-url="<?php echo $action;?>"
      data-target="#pgtSked"
      class="filtroFim col-xl-8">


      <div class="col-xl-4" style="margin-bottom:20px;">
      <?php

      $filtroPagamento=$dadosPagamento;

       echo form_dropdown(
                  'id_colaborador',
                  $comboColaborador,
                  $filtroPagamento['id_colaborador'],
                  'name="id_colaborador"
                   id="id_colaborador"
                   '
                ); ?>


    </div>
    <div class="col-xl-4" style="margin-bottom:20px;">
    <?php

    $filtroPagamento=$dadosPagamento;

     echo form_dropdown(
                'id_metodo_pagamento',
                $comboPagamentoMetodo,
                $filtroPagamento['id_metodo_pagamento'],
                'name="id_metodo_pagamento"
                 id="id_metodo_pagamento"
                 '
              ); ?>


  </div>
  <div class="col-xl-4" style="margin-bottom:20px;">
  <?php

  $filtroPagamento=$dadosPagamento;

   echo form_dropdown(
              'id_servico',
              $comboServico,
              $filtroPagamento['id_servico'],
              'name="id_servico"
               id="id_servico"
               '
            ); ?>


</div>
    <div class="col-xl-6">
      <?php $atributos = array(
                                  'name' => 'filtro_de',
                                  'id' => 'filtro_de',
                                  'value' => $filtroPagamento['filtro_de'],
                                  'type'=>'date',
                                  'title'=>'De',
                                  'required'=>'required');
                                  echo form_input($atributos);
                                  ?>
    </div>

    <div class="col-xl-6">
      <?php $atributos = array(
                                  'name' => 'filtro_ate',
                                  'id' => 'filtro_ate',
                                  'value' => $filtroPagamento['filtro_ate'],
                                  'type'=>'date',
                                  'title'=>'Até',
                                  'required'=>'required');
                                  echo form_input($atributos);
                                  ?>
    </div>


</form>

<div class="tab-conteudo row col-sm-8 boxSked">



  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Pagamento/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th> cod</th>
       <th> Cliente</th>
       <th> Serviço</th>
       <th> Hora</th>
       <th> Profissional</th>
       <th> Método .Pgt</th>
       <th> Valor</th>
       <th> ações</th>

     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaPagamento)):?>
      <?php foreach ($listaPagamento as $dadosPagamento):?>
       <tr >
            <td><?php  echo $dadosPagamento['id'] ?></td>
            <td><?php  echo  $dadosPagamento['nome_cliente']; ?></td>
            <td> <?php  echo $dadosPagamento['nome_servico'];; ?></td>
            <td> <?php  echo "00:00"; ?></td>
            <td> <?php  echo $dadosPagamento['nome_profissional']; ?></td>
            <td> <?php  echo $dadosPagamento['metodo']; ?></td>
            <td> R$ <?php  echo $dadosPagamento['valor']; ?></td>
            <td>

                <a data-href="<?php echo site_url('PagamentoServico/editar/'.$modal.'/'.$dadosPagamento['id']);?>" class="abrirPagina btn btn-info" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >
                  &#xf2bf;
                </a>
             </td>

      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="8">
         <?php echo $paginacao; ?>
         <b>  Total:</b>R$ <?php echo number_format($objPagamentoServico->valorTotal($filtroPagamento)[0]['valor'],2); ?>
       </td>
     </tr >


     <?php else:?>
      <tr>
        <td colspan="7">
          <div class="alert alert-danger" style="float: left; width:100%">
            Nenhum registro encontrado!
          </div>
        </td>
        <tr >
        <?php endif;?>

   </tbody>

    </table>

  </div>

  <div class="col-sm-4 grafico " style="margin-bottom:-100%;">

      <div class="card-body fixo" style="margin-bottom:20px;">
            <div class="chart-pie pt-4 pb-2">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class=""></div>
                </div>
              </div>
              <canvas id="pgtServ" width="100" height="95" class="chartjs-render-monitor" style="display: block; width: 200px; height: 300px;"></canvas>
            </div>
            <div class="mt-4 text-left small">
              <ul>

              <?php
              $count=0;
              $cores = ['#4e73df','#1cc88a','#46b9cc','#8e73df','#9cc38a','#76b9cc'];

               foreach ($listaServico as $value){ ?>
                 <li>
                <span class="col-lg-4">
                  <i class="fas fa-circle " style="color:<?php echo $cores[$count]; ?>"></i>
                 <?php echo $value; ?>
               </span>
                 </li>

                <?php $count++;} ?>


              </ul>



            </div>

    </div>

      <a data-href="<?php echo site_url('Tansacao/incluir/');?>"  class="abrirPagina btn btn-info btnSked "  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>  data-target="#vermodal" title="Incluir ">
         Nova Transação
      </a>
      <a data-href="<?php echo site_url('Pagamento/incluir/');?>"  class="abrirPagina btn btn-info btnSked"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>  data-target="#vermodal" title="Incluir ">
        Novo Pagamento
      </a>
  </div>
