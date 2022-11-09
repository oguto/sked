<fieldset>
    <? if ($flag == "1"): ?> 
    <div class="alert alert-success ">    
        <?= $sucesso; ?>
        <?endif;?>
        <? if ($flag ==null): ?> 
        <div class="alert alert-warning ">
            <?= $pergunta; ?>
            <a data-href="<?= $nao; ?>/1" class="btn btn-default abrirPagina" data-target="#vermodal">Não</a>
            <a data-href="<?= $sim; ?>/1" class="btn btn-default abrirPagina" data-target="#vermodal">Sim</a>
        </div>
        <?endif;?>
        <? if ($flag == "ERRO"): ?> 
        <div class="alert alert-success ">    
            Não foi possível fazer a exclusão 
            <?endif;?>
 </fieldset>
