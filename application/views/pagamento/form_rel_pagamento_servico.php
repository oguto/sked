
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosPagamentoServico['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="id_servico" >Servico: </label>
				<?php  echo form_dropdown(
                    'id_servico',
                    $comboServico,
                    $dadosPagamentoServico['id_servico'],
                    'name="id_servico" id="id_servico" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="id_pagamento" >Pagamento: </label>
				<?php  echo form_dropdown(
                    'id_pagamento',
                    $comboPagamento,
                    $dadosPagamentoServico['id_pagamento'],
                    'name="id_pagamento" id="id_pagamento" required'); ?>
			</div>
			<div class="col-xl-4">
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
			<button type="submit" class=" btn btn-info" >&#xf12e; Gerar Relatório</button>
		</div>
	</fieldset>

</form>
