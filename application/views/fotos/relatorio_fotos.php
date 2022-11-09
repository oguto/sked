 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Foto</td>
    <td>Descrição</td>
    <td>Personal</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><p class='fotoList shadow' style='background-image: url(<?php  echo $dadosFotos['foto'] ?>);'>
                    <?php if(empty($dadosFotos['foto'])){ echo ' <i class=fas fa-ship></i>';}?>
                    </p></td>
        <td><b>Descrição:</b> <?php  echo $dadosFotos['descricao'] ?></td>
        <td><b>Personal:</b> <?php  echo $dadosFotos['id_personal'] ?></td>
        </tr>
    <?php }?>      
  <?php }else{?>
    <tr> 
      <td>Nenhu dado foi encontrado</td>
    </tr>
  <?php }?>
   <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
</table>


