
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosEstado=autoCompletar($dadosEstado);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Nome:</b> <?php  echo $dadosEstado['nome'] ?></div>
    <div class='col-sm-9'><b>Uf:</b> <?php  echo $dadosEstado['uf'] ?></div>
    <div class='col-sm-9'><b>Pais:</b> <?php  echo $dadosEstado['pais'] ?></div>
    </div>
</fieldset>

