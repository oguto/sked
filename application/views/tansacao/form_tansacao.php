
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosTansacao['id']);?>

	<fieldset>
		<div class="form-group">

			<div class="col-xl-6">
				<label for="id_tipo" >Tipo: </label>
				<?php  echo form_dropdown(
										'id_tipo',
										$comboTansacaoTipo,
										$dadosTansacao['id_tipo'],
										'name="id_tipo" id="id_tipo" required'); ?>
			</div>
			<div class="col-xl-6">
				<label for="valor" >Valor: </label>
				<?php $atributos = array(
                                    'name' => 'valor',
                                    'id' => 'valor',
                                    'value' => $dadosTansacao['valor'],
                                    'type'=>'number',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-12">
				<label for="descricao" >Descrição: </label>
				<?php $atributos = array(
                                'name' => 'descricao',
                                'id' => 'descricao',
                                'value' => $dadosTansacao['descricao'],
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
