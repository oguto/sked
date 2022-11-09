
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosFormaPagmento=autoCompletar($dadosFormaPagmento);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Descrição:</b> <?php  echo $dadosFormaPagmento['descricao'] ?></div>
    </div>
</fieldset>

