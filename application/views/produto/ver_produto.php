
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosProduto=autoCompletar($dadosProduto);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-12'><b>Nome:</b> <?php  echo $dadosProduto['nome'] ?></div>
    <div class='col-sm-12'><b>Preco venda:</b> <?php  echo $dadosProduto['preco_venda'] ?></div>
    <div class='col-sm-12'><b>Preco custo:</b> <?php  echo $dadosProduto['preco_custo'] ?></div>
    <div class='col-sm-12'><b>Estoque:</b> <?php  echo $dadosProduto['estoque'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosProduto['data']) ?></div>
    <div class='col-sm-12'><b>Horas:</b> <?php  echo $dadosProduto['horas'] ?></div>
    </div>
</fieldset>

