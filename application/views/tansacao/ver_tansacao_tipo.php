
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosTansacaoTipo=autoCompletar($dadosTansacaoTipo);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosTansacaoTipo['nome'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosTansacaoTipo['data']) ?></div>
    </div>
</fieldset>

