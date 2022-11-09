
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosPagamentoServico=autoCompletar($dadosPagamentoServico);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-8'><b>Servico:</b> <?php  echo $dadosPagamentoServico['id_servico'] ?></div>
    <div class='col-sm-8'><b>Pagamento:</b> <?php  echo $dadosPagamentoServico['id_pagamento'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosPagamentoServico['data']) ?></div>
    </div>
</fieldset>

