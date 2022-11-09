 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosPagamentoMetodo))){ ?>

       <h1> Relatório De PagamentoMetodo</h1>

        <ul class="filtro">
          <?php if(!empty($dadosPagamentoMetodo['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosPagamentoMetodo['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosPagamentoMetodo['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosPagamentoMetodo['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De PagamentoMetodo </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaPagamentoMetodo)){?>
    <?php foreach ($listaPagamentoMetodo as $dadosPagamentoMetodo){?>
      <tr>
        <td><?php  echo $dadosPagamentoMetodo['nome']; ?></td>
        <td><?php  echo dataBR($dadosPagamentoMetodo['data']); ?></td>
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
