
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosComboDia['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="dia" >Dia: </label>
				<?php $atributos = array(   
                            'name' => 'dia',
                            'id' => 'dia',
                            'value' => $dadosComboDia['dia'],
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