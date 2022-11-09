
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosPagamentoServico['id']);?>

	<fieldset>
		<div class="form-group">

			<div class="col-xl-6">
				<label for="data" >Valor: </label>
				<?php $atributos = array(
                                    'name' => 'valor',
                                    'id' => 'valor',
                                    'value' => $dadosPagamentoServico['valor'],
                                    'type'=>'number',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>

			<div class="col-xl-6">
				<label for="data" >Data: </label>
				<?php $atributos = array(
																		'name' => 'data',
																		'id' => 'data',
																		'value' => $dadosPagamentoServico['data'],
																		'type'=>'date',
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
