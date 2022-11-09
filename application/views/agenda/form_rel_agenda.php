
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosAgenda['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="id_cliente" >Cliente: </label>
				<?php  echo form_dropdown(
                    'id_cliente',
                    $comboCliente,
                    $dadosAgenda['id_cliente'],
                    'name="id_cliente" id="id_cliente" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="id_profissional" >Profissional: </label>
				<?php  echo form_dropdown(
                    'id_profissional',
                    $comboColaborador,
                    $dadosAgenda['id_profissional'],
                    'name="id_profissional" id="id_profissional" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="id_servico" >Servico: </label>
				<?php  echo form_dropdown(
                    'id_servico',
                    $comboServico,
                    $dadosAgenda['id_servico'],
                    'name="id_servico" id="id_servico" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosAgenda['data'],
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
                                    'value' => $dadosAgenda['horas'],
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
