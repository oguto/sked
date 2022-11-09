
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosServico=autoCompletar($dadosServico);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosServico['nome'] ?></div>
    <div class='col-sm-12'><b>Preco venda:</b> <?php  echo $dadosServico['preco_venda'] ?></div>
    <div class='col-sm-12'><b>Desconto:</b> <?php  echo $dadosServico['desconto'] ?></div>
    <div class='col-sm-12'><b>Estoque:</b> <?php  echo $dadosServico['estoque'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosServico['data']) ?></div>
    <div class='col-sm-12'><b>Horas:</b> <?php  echo $dadosServico['horas'] ?></div>
    </div>
</fieldset>

