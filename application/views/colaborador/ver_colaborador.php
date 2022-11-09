
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosColaborador=autoCompletar($dadosColaborador);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Email:</b> <?php  echo $dadosColaborador['email'] ?></div>
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosColaborador['nome'] ?></div>
    <div class='col-sm-12'><b>Nascimento:</b> <?php  echo $dadosColaborador['nascimento'] ?></div>
    <div class='col-sm-12'><b>Cpf:</b> <?php  echo $dadosColaborador['cpf'] ?></div>
    <div class='col-sm-12'><b>Telefone:</b> <?php  echo $dadosColaborador['telefone'] ?></div>
    <div class='col-sm-12'><b>Cep:</b> <?php  echo $dadosColaborador['cep'] ?></div>
    <div class='col-sm-12'><b>Número:</b> <?php  echo $dadosColaborador['numero'] ?></div>
    <div class='col-sm-12'><b>Responsavel:</b> <?php  echo $dadosColaborador['responsavel'] ?></div>
    <div class='col-sm-12'><b>Endereço:</b> <?php  echo $dadosColaborador['endereco'] ?></div>
    <div class='col-sm-12'><b>Comissão:</b> <?php  echo $dadosColaborador['comissao'] ?></div>
    <div class='col-sm-12'><b>Senha:</b> <?php  echo $dadosColaborador['senha'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosColaborador['data']) ?></div>
    </div>
</fieldset>

