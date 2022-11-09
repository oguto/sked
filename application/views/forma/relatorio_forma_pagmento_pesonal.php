 <table class="table">

   <tr>
    <td><h1> Relatório </h1></td>
  </tr>
  <tr style="background-color:#ccc; ">
    <td>Forma pagamento</td>
    <td>Descrição</td>
    <td>Loja</td>
    </tr>

  <tr>
    <td><b>Total: <?php  echo $total; ?></b></td>
  </tr>
  <?php if(!empty($lista)){?>
    <?php foreach ($lista as $dados):?>
      <tr> 
        <td><b>Forma pagamento:</b> <?php  echo $dadosFormaPagmentoPesonal['id_forma_pagamento'] ?></td>
        <td><b>Descrição:</b> <?php  echo $dadosFormaPagmentoPesonal['descricao'] ?></td>
        <td><b>Loja:</b> <?php  echo $dadosFormaPagmentoPesonal['id_loja'] ?></td>
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


