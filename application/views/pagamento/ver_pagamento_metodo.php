
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosPagamentoMetodo=autoCompletar($dadosPagamentoMetodo);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosPagamentoMetodo['nome'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosPagamentoMetodo['data']) ?></div>
    </div>
</fieldset>

