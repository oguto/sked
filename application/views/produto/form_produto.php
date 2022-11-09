
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosProduto['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-12">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosProduto['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="preco_custo" >Preco custo: </label>
				<?php $atributos = array(
																		'name' => 'preco_custo',
																		'id' => 'preco_custo',
																		'value' => $dadosProduto['preco_custo'],
																		'required'=>'required');
																		echo form_input($atributos);
																		?>
			</div>

			<div class="col-xl-4">
				<label for="preco_venda" >Preco venda: </label>
				<?php $atributos = array(
                                    'name' => 'preco_venda',
                                    'id' => 'preco_venda',
                                    'value' => $dadosProduto['preco_venda'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>

			<div class="col-xl-4">
				<label for="estoque" >Estoque: </label>
				<?php $atributos = array(
                                    'name' => 'estoque',
                                    'id' => 'estoque',
                                    'value' => $dadosProduto['estoque'],
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
