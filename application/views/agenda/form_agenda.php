
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosAgenda['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-12">
				<label for="id_cliente" >Cliente: </label>
				<?php  echo form_dropdown(
                    'id_cliente',
                    $comboCliente,
                    $dadosAgenda['id_cliente'],
                    'name="id_cliente" id="id_cliente" required'); ?>
			</div>
	<div class="col-xl-12">

			<a data-href="<?php echo site_url('Cliente/incluir/true/true');?>"
				 class="abrirPagina btn btn-default"
					data-target="#vermodal" >
					  <i class="fas fa-plus"></i> Incluir cliente
				</a>
		</div>
			<div class="col-xl-12">
				<label for="id_profissional" >Profissional: </label>
				<?php  echo form_dropdown(
                    'id_profissional',
                    $comboColaborador,
                    $dadosAgenda['id_profissional'],
                    'name="id_profissional" id="id_profissional" required'); ?>
			</div>
			<div class="col-xl-12">
				<label for="id_servico" >Servico: </label>
				<?php  echo form_dropdown(
                    'id_servico',
                    $comboServico,
                    $dadosAgenda['id_servico'],
                    'name="id_servico" id="id_servico" required'); ?>
			</div>
			<div class="col-xl-6">
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
			<div class="col-xl-6">
				<label for="horas" >Horas: </label>

				<?php

			 $comboHoras=	arrayCombo("horas","horas",comboHoras(7, 21),"Selecione um horário");


			 echo form_dropdown(
											'horas',
											$comboHoras,
											horas($dadosAgenda['horas']),
											'name="horas" id="horas" required'); ?>



			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>
	</fieldset>

</form>
