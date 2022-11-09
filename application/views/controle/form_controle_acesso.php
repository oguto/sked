    <?php echo $abas;?>

    <form data-action="<?php echo $action ?>" load="#bodyModal" modal="true" destino="<?php echo $urlList ?>" class="enviaform usuarios" method="post" >
        <fieldset style="padding-top: 0px;" class="">
            <div>
              <?php echo form_hidden('id',$id);?>

             <?php echo $console; ?>
             <?php echo $controleAgenda; ?>
             <?php echo $controleCliente; ?>
             <?php echo $controleColaborador; ?>
             <?php echo $controlePagamento; ?>
             <?php echo $controleProduto; ?>
             <?php echo $controleServico; ?>
             <?php echo $controleTansacao; ?>


            <div class="botaoForm">
                <button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
                <button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
            </div>
        </fieldset>
    </form>
