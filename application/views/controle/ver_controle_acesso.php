
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosControleAcesso=autoCompletar($dadosControleAcesso);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-9'><b>Modulo:</b> <?php  echo $dadosControleAcesso['modulo'] ?></div>
    <div class='col-sm-9'><b>Geral:</b> <?php  echo $dadosControleAcesso['geral'] ?></div>
    <div class='col-sm-9'><b>Editar:</b> <?php  echo $dadosControleAcesso['editar'] ?></div>
    <div class='col-sm-9'><b>Visualizar:</b> <?php  echo $dadosControleAcesso['visualizar'] ?></div>
    <div class='col-sm-9'><b>Incluir:</b> <?php  echo $dadosControleAcesso['incluir'] ?></div>
    <div class='col-sm-9'><b>Excluir:</b> <?php  echo $dadosControleAcesso['excluir'] ?></div>
    <div class='col-sm-8'><b>Usuário:</b> <?php  echo $dadosControleAcesso['id_usuario'] ?></div>
    </div>
</fieldset>

