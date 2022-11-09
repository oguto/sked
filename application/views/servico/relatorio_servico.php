 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosServico))){ ?>

       <h1> Relatório De Servico</h1>

        <ul class="filtro">
          <?php if(!empty($dadosServico['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosServico['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosServico['preco_venda'])){ ?>
               <li>
                 <b>Preco venda</b>
                <?php  echo $dadosServico['preco_venda']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosServico['desconto'])){ ?>
               <li>
                 <b>Desconto</b>
                <?php  echo $dadosServico['desconto']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosServico['estoque'])){ ?>
               <li>
                 <b>Estoque</b>
                <?php  echo $dadosServico['estoque']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosServico['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosServico['data']); ?>
              </li>
              <?php } ?>
          <?php if(!empty($dadosServico['horas'])){ ?>
               <li>
                 <b>Horas</b>
                <?php  echo $dadosServico['horas']; ?>
              </li>
            <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Servico </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Preco venda</td>
    <td>Desconto</td>
    <td>Estoque</td>
    <td>Data</td>
    <td>Horas</td>
    </tr>


  <?php if(!empty($listaServico)){?>
    <?php foreach ($listaServico as $dadosServico){?>
      <tr>
        <td><?php  echo $dadosServico['nome']; ?></td>
        <td><?php  echo $dadosServico['preco_venda']; ?></td>
        <td><?php  echo $dadosServico['desconto']; ?></td>
        <td><?php  echo $dadosServico['estoque']; ?></td>
        <td><?php  echo dataBR($dadosServico['data']); ?></td>
        <td><?php  echo $dadosServico['horas']; ?></td>
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
