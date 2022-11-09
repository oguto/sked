 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Cep</td>
    <td>Estado</td>
    <td>Cidade</td>
    <td>Data</td>
    <td>Bairro</td>
    <td>Complemento</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Cep:</b> <?php  echo $dadosEndereco['cep'] ?></td>
        <td><b>Estado:</b> <?php  echo $dadosEndereco['estado'] ?></td>
        <td><b>Cidade:</b> <?php  echo $dadosEndereco['cidade'] ?></td>
        <td><b>Data:</b> <?php  echo $dadosEndereco['data'] ?></td>
        <td><b>Bairro:</b> <?php  echo $dadosEndereco['bairro'] ?></td>
        <td><b>Complemento:</b> <?php  echo $dadosEndereco['complemento'] ?></td>
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


