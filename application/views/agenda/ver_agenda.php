
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosAgenda=autoCompletar($dadosAgenda);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-8'><b>Cliente:</b> <?php  echo $dadosAgenda['id_cliente'] ?></div>
    <div class='col-sm-8'><b>Profissional:</b> <?php  echo $dadosAgenda['id_profissional'] ?></div>
    <div class='col-sm-8'><b>Servico:</b> <?php  echo $dadosAgenda['id_servico'] ?></div>
    <div class='col-sm-12'><b>Data:</b> <?php  echo dataBR($dadosAgenda['data']) ?></div>
    <div class='col-sm-12'><b>Horas:</b> <?php  echo $dadosAgenda['horas'] ?></div>
    </div>
</fieldset>

