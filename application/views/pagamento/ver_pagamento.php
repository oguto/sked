
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosPagamento=autoCompletar($dadosPagamento);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Abatimento:</b> <?php  echo $dadosPagamento['abatimento'] ?></div>
    <div class='col-sm-8'><b>Colaborador:</b> <?php  echo $dadosPagamento['id_colaborador'] ?></div>
    <div class='col-sm-12'><b>Tipo:</b> <?php  echo $dadosPagamento['tipo'] ?></div>
    <div class='col-sm-12'><b>Observacoes:</b> <?php  echo $dadosPagamento['observacoes'] ?></div>
    <div class='col-sm-8'><b>Cliente:</b> <?php  echo $dadosPagamento['id_cliente'] ?></div>
    <div class='col-sm-8'><b>Metodo pagamento:</b> <?php  echo $dadosPagamento['id_metodo_pagamento'] ?></div>
    <div class='col-sm-12'><b>Parcelamento:</b> <?php  echo $dadosPagamento['parcelamento'] ?></div>
    <div class='col-sm-12'><b>Valor:</b> <?php  echo $dadosPagamento['valor'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosPagamento['data']) ?></div>
    </div>
</fieldset>

