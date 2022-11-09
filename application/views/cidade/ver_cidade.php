
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosCidade=autoCompletar($dadosCidade);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Nome:</b> <?php  echo $dadosCidade['nome'] ?></div>
    <div class='col-sm-9'><b>Estado:</b> <?php  echo $dadosCidade['estado'] ?></div>
    </div>
</fieldset>

