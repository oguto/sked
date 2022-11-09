 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Modulo</td>
    <td>Geral</td>
    <td>Editar</td>
    <td>Visualizar</td>
    <td>Incluir</td>
    <td>Excluir</td>
    <td>Usuário</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Modulo:</b> <?php  echo $dadosControleAcesso['modulo'] ?></td>
        <td><b>Geral:</b> <?php  echo $dadosControleAcesso['geral'] ?></td>
        <td><b>Editar:</b> <?php  echo $dadosControleAcesso['editar'] ?></td>
        <td><b>Visualizar:</b> <?php  echo $dadosControleAcesso['visualizar'] ?></td>
        <td><b>Incluir:</b> <?php  echo $dadosControleAcesso['incluir'] ?></td>
        <td><b>Excluir:</b> <?php  echo $dadosControleAcesso['excluir'] ?></td>
        <td><b>Usuário:</b> <?php  echo $dadosControleAcesso['id_usuario'] ?></td>
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


