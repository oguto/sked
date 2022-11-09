
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosCliente=autoCompletar($dadosCliente);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosCliente['nome'] ?></div>
    <div class='col-sm-12'><b>Telefone:</b> <?php  echo $dadosCliente['telefone'] ?></div>
    <div class='col-sm-12'><b>Email:</b> <?php  echo $dadosCliente['email'] ?></div>
    <div class='col-sm-12'><b>Nascimento:</b> <?php  echo $dadosCliente['nascimento'] ?></div>
    <div class='col-sm-12'><b>Cep:</b> <?php  echo $dadosCliente['cep'] ?></div>
    <div class='col-sm-12'><b>Número:</b> <?php  echo $dadosCliente['numero'] ?></div>
    <div class='col-sm-12'><b>Endereço:</b> <?php  echo $dadosCliente['endereco'] ?></div>
    <div class='col-sm-12'><b>Responsavel:</b> <?php  echo $dadosCliente['responsavel'] ?></div>
    <div class='col-sm-12'><b>Contato responsavel:</b> <?php  echo $dadosCliente['contato_responsavel'] ?></div>
    <div class='col-sm-12'><b>Senha:</b> <?php  echo $dadosCliente['senha'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosCliente['data']) ?></div>
    </div>
</fieldset>

