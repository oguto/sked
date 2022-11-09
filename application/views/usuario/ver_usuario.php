
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosUsuario=autoCompletar($dadosUsuario);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Tipo:</b> <?php  echo $dadosUsuario['tipo'] ?></div>
    <div class='col-sm-9'><b>Nome:</b> <?php  echo $dadosUsuario['nome'] ?></div>
    <div class='col-sm-9'><b>Email:</b> <?php  echo $dadosUsuario['email'] ?></div>
    <div class='col-sm-9'><b>Senha:</b> <?php  echo $dadosUsuario['senha'] ?></div>
    </div>
</fieldset>

