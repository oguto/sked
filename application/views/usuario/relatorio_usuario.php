 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Tipo</td>
    <td>Nome</td>
    <td>Email</td>
    <td>Senha</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Tipo:</b> <?php  echo $dadosUsuario['tipo'] ?></td>
        <td><b>Nome:</b> <?php  echo $dadosUsuario['nome'] ?></td>
        <td><b>Email:</b> <?php  echo $dadosUsuario['email'] ?></td>
        <td><b>Senha:</b> <?php  echo $dadosUsuario['senha'] ?></td>
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


