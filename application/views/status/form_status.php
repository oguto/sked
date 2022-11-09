
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosStatus['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="descricao" >Descrição: </label>
				<?php $atributos = array(   
                            'name' => 'descricao',
                            'id' => 'descricao',
                            'value' => $dadosStatus['descricao'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="id_modulo" >Modulo: </label>
				<?php  echo form_dropdown(
                'id_modulo',
                $comboModulo,
                $dadosStatus['id_modulo'],
                'name="id_modulo" id="id_modulo" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="id_status" >Status: </label>
				<?php  echo form_dropdown(
                'id_status',
                $comboStatus,
                $dadosStatus['id_status'],
                'name="id_status" id="id_status" required'); ?>
			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>    
	</fieldset>
	
</form>