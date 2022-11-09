
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosComboDia=autoCompletar($dadosComboDia);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Dia:</b> <?php  echo $dadosComboDia['dia'] ?></div>
    </div>
</fieldset>

