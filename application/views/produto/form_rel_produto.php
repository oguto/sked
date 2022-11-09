
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosProduto['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
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
				<label for="estoque" >Estoque: </label>
				<?php $atributos = array(
                                    'name' => 'estoque',
                                    'id' => 'estoque',
                                    'value' => $dadosProduto['estoque'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosProduto['data'],
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
                                    'value' => $dadosProduto['horas'],
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
