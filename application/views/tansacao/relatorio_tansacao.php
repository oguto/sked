 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosTansacao))){ ?>

       <h1> Relatório De Tansacao</h1>

        <ul class="filtro">
          <?php if(!empty($dadosTansacao['descricao'])){ ?>
               <li>
                 <b>Descrição</b>
                <?php  echo $dadosTansacao['descricao']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosTansacao['id_tipo'])){ ?>
                 <li>
                   <b>Tipo</b>
                   <?php echo $objTansacaoTipo->ver($dadosTansacao['id_tipo'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosTansacao['valor'])){ ?>
               <li>
                 <b>Valor</b>
                <?php  echo $dadosTansacao['valor']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosTansacao['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosTansacao['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Tansacao </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Descrição</td>
    <td>Tipo</td>
    <td>Valor</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaTansacao)){?>
    <?php foreach ($listaTansacao as $dadosTansacao){?>
      <tr>
        <td><?php  echo $dadosTansacao['descricao']; ?></td>
        <td><?php echo $objTansacaoTipo->ver($dadosTansacao['id_tipo'])['nome'];?></td>
        <td><?php  echo $dadosTansacao['valor']; ?></td>
        <td><?php  echo dataBR($dadosTansacao['data']); ?></td>
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
