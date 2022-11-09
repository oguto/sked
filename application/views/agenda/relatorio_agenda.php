 <table class="table">

   <tr>
    <td colspan="<?php  echo $colunas; ?>">


     <?php if(!empty(array_filter($dadosAgenda))){ ?>

       <h1> Relatório De Agenda</h1>

        <ul class="filtro">
          <?php if(!empty($dadosAgenda['id_cliente'])){ ?>
                 <li>
                   <b>Cliente</b>
                   <?php echo $objCliente->ver($dadosAgenda['id_cliente'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosAgenda['id_profissional'])){ ?>
                 <li>
                   <b>Profissional</b>
                   <?php echo $objColaborador->ver($dadosAgenda['id_profissional'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosAgenda['id_servico'])){ ?>
                 <li>
                   <b>Servico</b>
                   <?php echo $objServico->ver($dadosAgenda['id_servico'])['nome']; ?>
                 </li>
               <?php } ?>
          <?php if(!empty($dadosAgenda['data'])){ ?>
               <li>
                 <b>Data</b>
                <?php  echo dataBR($dadosAgenda['data']); ?>
              </li>
              <?php } ?>
          <?php if(!empty($dadosAgenda['horas'])){ ?>
               <li>
                 <b>Horas</b>
                <?php  echo $dadosAgenda['horas']; ?>
              </li>
            <?php } ?>
          </ul>
    <?php }else{ ?>

       <h1> Relatório Geral De Agenda </h1>

    <?php } ?>

    </td>
  </tr>

  <tr style="background-color:#ccc; ">
    <td>Cliente</td>
    <td>Profissional</td>
    <td>Servico</td>
    <td>Data</td>
    <td>Horas</td>
    </tr>


  <?php if(!empty($listaAgenda)){?>
    <?php foreach ($listaAgenda as $dadosAgenda){?>
      <tr>
        <td><?php echo $objCliente->ver($dadosAgenda['id_cliente'])['nome'];?></td>
        <td><?php echo $objColaborador->ver($dadosAgenda['id_profissional'])['nome'];?></td>
        <td><?php echo $objServico->ver($dadosAgenda['id_servico'])['nome'];?></td>
        <td><?php  echo dataBR($dadosAgenda['data']); ?></td>
        <td><?php  echo $dadosAgenda['horas']; ?></td>
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
