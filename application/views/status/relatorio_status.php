 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Descrição</td>
    <td>Modulo</td>
    <td>Status</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Descrição:</b> <?php  echo $dadosStatus['descricao'] ?></td>
        <td><b>Modulo:</b> <?php  echo $dadosStatus['id_modulo'] ?></td>
        <td><b>Status:</b> <?php  echo $dadosStatus['id_status'] ?></td>
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


