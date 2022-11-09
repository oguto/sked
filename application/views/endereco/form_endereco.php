
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosEndereco['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="cep" >Cep: </label>
				<?php $atributos = array(   
                            'name' => 'cep',
                            'id' => 'cep',
                            'value' => $dadosEndereco['cep'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="estado" >Estado: </label>
				<?php $atributos = array(   
                            'name' => 'estado',
                            'id' => 'estado',
                            'value' => $dadosEndereco['estado'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="cidade" >Cidade: </label>
				<?php $atributos = array(   
                            'name' => 'cidade',
                            'id' => 'cidade',
                            'value' => $dadosEndereco['cidade'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(   
                            'name' => 'data',
                            'id' => 'data',
                            'value' => $dadosEndereco['data'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="bairro" >Bairro: </label>
				<?php $atributos = array(   
                            'name' => 'bairro',
                            'id' => 'bairro',
                            'value' => $dadosEndereco['bairro'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="complemento" >Complemento: </label>
				<?php $atributos = array(
                            'name' => 'complemento',
                            'id' => 'complemento',
                            'value' => $dadosEndereco['complemento'],
                            'class'=>'tinymce',
                            'required'=>'required');
                            echo form_textarea($atributos);?>
			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>    
	</fieldset>
	
</form>