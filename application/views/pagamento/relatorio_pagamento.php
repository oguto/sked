 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosPagamento))){ ?>

       <h1> Relatório De Pagamento</h1>

        <ul class="filtro">
          <?php if(!empty($dadosPagamento['abatimento'])){ ?>
               <li>
                 <b>Abatimento</b>
                <?php  echo $dadosPagamento['abatimento']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamento['id_colaborador'])){ ?>
                 <li>
                   <b>Colaborador</b>
                   <?php echo $objColaborador->ver($dadosPagamento['id_colaborador'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosPagamento['tipo'])){ ?>
               <li>
                 <b>Tipo</b>
                <?php  echo $dadosPagamento['tipo']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamento['observacoes'])){ ?>
               <li>
                 <b>Observacoes</b>
                <?php  echo $dadosPagamento['observacoes']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamento['id_cliente'])){ ?>
                 <li>
                   <b>Cliente</b>
                   <?php echo $objCliente->ver($dadosPagamento['id_cliente'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosPagamento['id_metodo_pagamento'])){ ?>
                 <li>
                   <b>Metodo pagamento</b>
                   <?php echo $objPagamentoMetodo->ver($dadosPagamento['id_metodo_pagamento'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosPagamento['parcelamento'])){ ?>
               <li>
                 <b>Parcelamento</b>
                <?php  echo $dadosPagamento['parcelamento']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamento['valor'])){ ?>
               <li>
                 <b>Valor</b>
                <?php  echo $dadosPagamento['valor']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamento['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosPagamento['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Pagamento </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Abatimento</td>
    <td>Colaborador</td>
    <td>Tipo</td>
    <td>Observacoes</td>
    <td>Cliente</td>
    <td>Metodo pagamento</td>
    <td>Parcelamento</td>
    <td>Valor</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaPagamento)){?>
    <?php foreach ($listaPagamento as $dadosPagamento){?>
      <tr>
        <td><?php  echo $dadosPagamento['abatimento']; ?></td>
        <td><?php echo $objColaborador->ver($dadosPagamento['id_colaborador'])['nome'];?></td>
        <td><?php  echo $dadosPagamento['tipo']; ?></td>
        <td><?php  echo $dadosPagamento['observacoes']; ?></td>
        <td><?php echo $objCliente->ver($dadosPagamento['id_cliente'])['nome'];?></td>
        <td><?php echo $objPagamentoMetodo->ver($dadosPagamento['id_metodo_pagamento'])['nome'];?></td>
        <td><?php  echo $dadosPagamento['parcelamento']; ?></td>
        <td><?php  echo $dadosPagamento['valor']; ?></td>
        <td><?php  echo dataBR($dadosPagamento['data']); ?></td>
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
