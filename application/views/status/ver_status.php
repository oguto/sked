
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosStatus=autoCompletar($dadosStatus);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Descrição:</b> <?php  echo $dadosStatus['descricao'] ?></div>
    <div class='col-sm-8'><b>Modulo:</b> <?php  echo $dadosStatus['id_modulo'] ?></div>
    <div class='col-sm-8'><b>Status:</b> <?php  echo $dadosStatus['id_status'] ?></div>
    </div>
</fieldset>

