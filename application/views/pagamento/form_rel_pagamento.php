
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosPagamento['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="abatimento" >Abatimento: </label>
				<?php $atributos = array(
                                    'name' => 'abatimento',
                                    'id' => 'abatimento',
                                    'value' => $dadosPagamento['abatimento'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="id_colaborador" >Colaborador: </label>
				<?php  echo form_dropdown(
                    'id_colaborador',
                    $comboColaborador,
                    $dadosPagamento['id_colaborador'],
                    'name="id_colaborador" id="id_colaborador" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="tipo" >Tipo: </label>
				<?php $atributos = array(
                                    'name' => 'tipo',
                                    'id' => 'tipo',
                                    'value' => $dadosPagamento['tipo'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="observacoes" >Observacoes: </label>
				<?php $atributos = array(
                                    'name' => 'observacoes',
                                    'id' => 'observacoes',
                                    'value' => $dadosPagamento['observacoes'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="id_cliente" >Cliente: </label>
				<?php  echo form_dropdown(
                    'id_cliente',
                    $comboCliente,
                    $dadosPagamento['id_cliente'],
                    'name="id_cliente" id="id_cliente" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="id_metodo_pagamento" >Metodo pagamento: </label>
				<?php  echo form_dropdown(
                    'id_metodo_pagamento',
                    $comboPagamentoMetodo,
                    $dadosPagamento['id_metodo_pagamento'],
                    'name="id_metodo_pagamento" id="id_metodo_pagamento" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="parcelamento" >Parcelamento: </label>
				<?php $atributos = array(
                                    'name' => 'parcelamento',
                                    'id' => 'parcelamento',
                                    'value' => $dadosPagamento['parcelamento'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="valor" >Valor: </label>
				<?php $atributos = array(
                                    'name' => 'valor',
                                    'id' => 'valor',
                                    'value' => $dadosPagamento['valor'],
                                    'type'=>'number',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosPagamento['data'],
                                    'type'=>'date',
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
