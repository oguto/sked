
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosServico['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosServico['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="preco_venda" >Preco venda: </label>
				<?php $atributos = array(
                                    'name' => 'preco_venda',
                                    'id' => 'preco_venda',
                                    'value' => $dadosServico['preco_venda'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="desconto" >Desconto: </label>
				<?php $atributos = array(
                                    'name' => 'desconto',
                                    'id' => 'desconto',
                                    'value' => $dadosServico['desconto'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="estoque" >Estoque: </label>
				<?php $atributos = array(
                                    'name' => 'estoque',
                                    'id' => 'estoque',
                                    'value' => $dadosServico['estoque'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosServico['data'],
                                    'type'=>'date',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
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
			<button type="submit" class=" btn btn-info" >&#xf12e; Gerar Relatório</button>
		</div>
	</fieldset>

</form>
