 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Nome</td>
    <td>Uf</td>
    <td>Pais</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Nome:</b> <?php  echo $dadosEstado['nome'] ?></td>
        <td><b>Uf:</b> <?php  echo $dadosEstado['uf'] ?></td>
        <td><b>Pais:</b> <?php  echo $dadosEstado['pais'] ?></td>
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


