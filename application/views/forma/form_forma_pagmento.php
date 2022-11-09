
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosFormaPagmento['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="descricao" >Descrição: </label>
				<?php $atributos = array(   
                            'name' => 'descricao',
                            'id' => 'descricao',
                            'value' => $dadosFormaPagmento['descricao'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>    
	</fieldset>
	
</form>