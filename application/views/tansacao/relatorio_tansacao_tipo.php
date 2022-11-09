 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosTansacaoTipo))){ ?>

       <h1> Relatório De TansacaoTipo</h1>

        <ul class="filtro">
          <?php if(!empty($dadosTansacaoTipo['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosTansacaoTipo['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosTansacaoTipo['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosTansacaoTipo['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De TansacaoTipo </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaTansacaoTipo)){?>
    <?php foreach ($listaTansacaoTipo as $dadosTansacaoTipo){?>
      <tr>
        <td><?php  echo $dadosTansacaoTipo['nome']; ?></td>
        <td><?php  echo dataBR($dadosTansacaoTipo['data']); ?></td>
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
