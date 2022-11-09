<fieldset>
    <?php if ($exclue == "1"): ?> 
        <div class="alert alert-success ">    
        <?php echo $sucesso; ?>
        </div>
    <?php elseif ($exclue == "0"): ?> 
        <div class="alert alert-warning ">
        <?php echo $pergunta; ?>
        <a  class=" btn btn-default abrir-modal" style="margin-left: 10px;" data-dismiss="modal">Não</a>
        <a data-href="<?= $excluir; ?>/1" class="btn btn-default excluirPadrao" modal="<?= $modal ?>"  destino="<?= $destino ?>" load="<?= $load ?>" >Sim</a>
        </div>
    <?php elseif ($exclue == "ERRO"): ?> 
        <div class="alert alert-success ">    
        Não foi possível fazer a exclusão 
        </div>
    <?php endif;?>
 </fieldset>
