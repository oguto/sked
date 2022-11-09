
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosPagamentoMetodo['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-12">
				<label for="nome" >Método de Pagamento: </label>
				<?php $atributos = array(
                                'name' => 'nome',
                                'id' => 'nome',
                                'value' => $dadosPagamentoMetodo['nome'],
                                'required'=>'required');
                                echo form_input($atributos);?>
			</div>

			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>
	</fieldset>

</form>
