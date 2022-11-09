 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosAdmin))){ ?>

       <h1> Relatório De Admin</h1>

        <ul class="filtro">
          <?php if(!empty($dadosAdmin['email'])){ ?>
               <li>
                 <b>Email</b>
                <?php  echo $dadosAdmin['email']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosAdmin['nome'])){ ?>
               <li>
                 <b>Nome</b>
                <?php  echo $dadosAdmin['nome']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosAdmin['senha'])){ ?>
               <li>
                 <b>Senha</b>
                <?php  echo $dadosAdmin['senha']; ?>
              </li>
            <?php } ?>
          <?php if(!empty($dadosAdmin['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosAdmin['data']); ?>
              </li>
              <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Admin </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Email</td>
    <td>Nome</td>
    <td>Senha</td>
    <td>Data</td>
    </tr>


  <?php if(!empty($listaAdmin)){?>
    <?php foreach ($listaAdmin as $dadosAdmin){?>
      <tr>
        <td><?php  echo $dadosAdmin['email']; ?></td>
        <td><?php  echo $dadosAdmin['nome']; ?></td>
        <td><?php  echo $dadosAdmin['senha']; ?></td>
        <td><?php  echo dataBR($dadosAdmin['data']); ?></td>
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
