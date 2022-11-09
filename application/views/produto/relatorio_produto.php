 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosProduto))){ ?>

       <h1> Relatório De Produto</h1>

        <ul class="filtro">
          <?php if(!empty($dadosProduto['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosProduto['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosProduto['preco_venda'])){ ?>
               <li>
                 <b>Preco venda</b>
                <?php  echo $dadosProduto['preco_venda']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosProduto['preco_custo'])){ ?>
               <li>
                 <b>Preco custo</b>
                <?php  echo $dadosProduto['preco_custo']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosProduto['estoque'])){ ?>
               <li>
                 <b>Estoque</b>
                <?php  echo $dadosProduto['estoque']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosProduto['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosProduto['data']); ?>
              </li>
              <?php } ?>
          <?php if(!empty($dadosProduto['horas'])){ ?>
               <li>
                 <b>Horas</b>
                <?php  echo $dadosProduto['horas']; ?>
              </li>
            <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Produto </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Preco venda</td>
    <td>Preco custo</td>
    <td>Estoque</td>
    <td>Data</td>
    <td>Horas</td>
    </tr>


  <?php if(!empty($listaProduto)){?>
    <?php foreach ($listaProduto as $dadosProduto){?>
      <tr>
        <td><?php  echo $dadosProduto['nome']; ?></td>
        <td><?php  echo $dadosProduto['preco_venda']; ?></td>
        <td><?php  echo $dadosProduto['preco_custo']; ?></td>
        <td><?php  echo $dadosProduto['estoque']; ?></td>
        <td><?php  echo dataBR($dadosProduto['data']); ?></td>
        <td><?php  echo $dadosProduto['horas']; ?></td>
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
