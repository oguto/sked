
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosTansacao=autoCompletar($dadosTansacao);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Descrição:</b> <?php  echo $dadosTansacao['descricao'] ?></div>
    <div class='col-sm-8'><b>Tipo:</b> <?php  echo $dadosTansacao['id_tipo'] ?></div>
    <div class='col-sm-12'><b>Valor:</b> <?php  echo $dadosTansacao['valor'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosTansacao['data']) ?></div>
    </div>
</fieldset>

