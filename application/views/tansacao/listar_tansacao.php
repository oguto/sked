<?php echo  $console; ?>

<div class="tab-conteudo row col-sm-12 ">

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Tansacao/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th colspan="5" style="border-top:0px; text-align:center;">
         Registro de movimentações do caixa
       </th>

     </tr>
     <tr>
      <th colspan="5">
        <form data-url="<?php echo $action;?>"
              data-target="#transSked"
              class="filtroTrans col-xl-12">
        <div class="col-xl-4" style="margin-bottom:20px;">

        <?php

        $filtroTransacao=$dadosTansacao;


         echo form_dropdown(
                    'id_tipo',
                    $comboTansacaoTipo,
                    $filtroTransacao['id_tipo'],
                    'name="id_tipo"
                     id="id_tipo"
                     '
                  ); ?>
                </div>

                <div class="col-xl-4">
                  <?php $atributos = array(
                                              'name' => 'filtro_de',
                                              'id' => 'filtro_de',
                                              'value' => $filtroTransacao['filtro_de'],
                                              'type'=>'date',
                                              'required'=>'required');
                                              echo form_input($atributos);
                                              ?>
                </div>

                <div class="col-xl-4">
                  <?php $atributos = array(
                                              'name' => 'filtro_ate',
                                              'id' => 'filtro_ate',
                                              'value' => $filtroTransacao['filtro_ate'],
                                              'type'=>'date',
                                              'required'=>'required');
                                              echo form_input($atributos);
                                              ?>
                </div>

              </form>



      </th>

    </tr>
       <tr>
        <th>Data</th>
        <th>Tipo de Transação</th>
        <th>Descrição</th>
        <th>Valor</th>
      </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaTansacao)):?>
      <?php foreach ($listaTansacao as $dadosTansacao):?>
       <tr >

              <td> <?php  echo dataBR($dadosTansacao['data']); ?></td>
              <td> <?php  echo $objTansacaoTipo->ver($dadosTansacao['id_tipo'])['nome']; ?></td>
            <td><?php  echo $dadosTansacao['descricao']; ?></td>
            <td> <?php  echo $dadosTansacao['valor']; ?></li>


      <tr >
      <?php endforeach;?>

      <tr>
        <td colspan="4">
           <b>  Total:</b> R$ <?php echo number_format($objTansacao->valorTotal($filtroTransacao)[0]['valor'],2); ?>
        </td>
      </tr >


     <?php else:?>
      <tr>
        <td colspan="4">
          <div class="alert alert-danger" style="float: left; width:100%">
            Nenhum registro encontrado!
          </div>
        </td>
      </tr >
        <?php endif;?>
      </tbody>
    </table>

  </div>
