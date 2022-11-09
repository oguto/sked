
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosServico['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-12">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosServico['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="preco_venda" >Preço venda: </label>
				<?php $atributos = array(
                                    'name' => 'preco_venda',
                                    'id' => 'preco_venda',
                                    'value' => $dadosServico['preco_venda'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="desconto" >Desconto: </label>
				<?php $atributos = array(
                                    'name' => 'desconto',
                                    'id' => 'desconto',
                                    'value' => $dadosServico['desconto'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="estoque" >Duracao: </label>
				<?php $atributos = array(
                                    'name' => 'estoque',
                                    'id' => 'estoque',
                                    'value' => $dadosServico['estoque'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>

			<div class="col-xl-6">
				<label for="horas" >Horas: </label>
				<?php $atributos = array(
                                    'name' => 'horas',
                                    'id' => 'horas',
                                    'value' => $dadosServico['horas'],
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
