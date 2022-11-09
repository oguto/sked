
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosEndereco=autoCompletar($dadosEndereco);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Cep:</b> <?php  echo $dadosEndereco['cep'] ?></div>
    <div class='col-sm-9'><b>Estado:</b> <?php  echo $dadosEndereco['estado'] ?></div>
    <div class='col-sm-9'><b>Cidade:</b> <?php  echo $dadosEndereco['cidade'] ?></div>
    <div class='col-sm-9'><b>Data:</b> <?php  echo $dadosEndereco['data'] ?></div>
    <div class='col-sm-9'><b>Bairro:</b> <?php  echo $dadosEndereco['bairro'] ?></div>
    <div class='col-sm-9'><b>Complemento:</b> <?php  echo $dadosEndereco['complemento'] ?></div>
    </div>
</fieldset>

