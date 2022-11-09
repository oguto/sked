 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosPagamentoServico))){ ?>

       <h1> Relatório De PagamentoServico</h1>

        <ul class="filtro">
          <?php if(!empty($dadosPagamentoServico['id_servico'])){ ?>
                 <li>
                   <b>Servico</b>
                   <?php echo $objServico->ver($dadosPagamentoServico['id_servico'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosPagamentoServico['id_pagamento'])){ ?>
                 <li>
                   <b>Pagamento</b>
                   <?php echo $objPagamento->ver($dadosPagamentoServico['id_pagamento'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosPagamentoServico['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosPagamentoServico['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De PagamentoServico </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Servico</td>
    <td>Pagamento</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaPagamentoServico)){?>
    <?php foreach ($listaPagamentoServico as $dadosPagamentoServico){?>
      <tr>
        <td><?php echo $objServico->ver($dadosPagamentoServico['id_servico'])['nome'];?></td>
        <td><?php echo $objPagamento->ver($dadosPagamentoServico['id_pagamento'])['nome'];?></td>
        <td><?php  echo dataBR($dadosPagamentoServico['data']); ?></td>
        </tr>
    <?php }?>
  <?php }else{?>
    <tr colspan="<?php  echo $colunas; ?>">
      <td>Nenhum registro foi encontrado</td>
    </tr>
  <?php }?>
   <tr >
    <td colspan="<?php  echo $colunas; ?>"><b>Total: <?php  echo $total; ?></b></td>
  </tr>
</table>
