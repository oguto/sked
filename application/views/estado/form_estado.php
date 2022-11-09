
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosEstado['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(   
                            'name' => 'nome',
                            'id' => 'nome',
                            'value' => $dadosEstado['nome'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="uf" >Uf: </label>
				<?php $atributos = array(   
                            'name' => 'uf',
                            'id' => 'uf',
                            'value' => $dadosEstado['uf'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="pais" >Pais: </label>
				<?php $atributos = array(   
                            'name' => 'pais',
                            'id' => 'pais',
                            'value' => $dadosEstado['pais'],
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