
<?php

function autoCompletarVar($var){
 if($var==null){
  $var= "<i>Não informado!</i>";
}

return $var;
}
$dadosFotos=autoCompletar($dadosFotos);

?>
<?php echo $abas;?> 
<fieldset >
  <div class="visualizar " style=" border-radius: 0px 0px 4px 4px;">
    <?php echo $console;?> 
    <div class='col-sm-3'><p class='verImg shadow' style='background-image: url(<?php  echo $dadosFotos['foto'] ?>); height: 300px'>
                   <?php if(empty($dadosFotos['foto'])){ echo ' <i class=fas fa-ship></i>';}?>
                   </p></div>
    <div class='col-sm-9'><b>Descrição:</b> <?php  echo $dadosFotos['descricao'] ?></div>
    <div class='col-sm-8'><b>Personal:</b> <?php  echo $dadosFotos['id_personal'] ?></div>
    </div>
</fieldset>

