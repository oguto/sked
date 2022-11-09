
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosAdmin=autoCompletar($dadosAdmin);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Email:</b> <?php  echo $dadosAdmin['email'] ?></div>
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosAdmin['nome'] ?></div>
    <div class='col-sm-12'><b>Senha:</b> <?php  echo $dadosAdmin['senha'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosAdmin['data']) ?></div>
    </div>
</fieldset>

