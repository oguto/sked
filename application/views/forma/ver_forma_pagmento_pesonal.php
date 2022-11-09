
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosFormaPagmentoPesonal=autoCompletar($dadosFormaPagmentoPesonal);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-8'><b>Forma pagamento:</b> <?php  echo $dadosFormaPagmentoPesonal['id_forma_pagamento'] ?></div>
    <div class='col-sm-9'><b>Descrição:</b> <?php  echo $dadosFormaPagmentoPesonal['descricao'] ?></div>
    <div class='col-sm-8'><b>Loja:</b> <?php  echo $dadosFormaPagmentoPesonal['id_loja'] ?></div>
    </div>
</fieldset>

