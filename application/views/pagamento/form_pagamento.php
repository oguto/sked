
<?php echo $abas;?>

<form
	data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	class=" enviarFormPagamento"
	name="form_pagamento"
	method="post" >

	<?php echo form_hidden('id',$dadosPagamento['id']);?>

	<?php echo form_hidden('tipo',$dadosPagamento['tipo']);?>

	<fieldset>
		<div class="form-group">


				<div class="col-xl-12">
				<label for="id_cliente" >Cliente: </label>
				<?php  echo form_dropdown(
										'id_cliente',
										$comboCliente,
										$dadosPagamento['id_cliente'],
										'name="id_cliente" id="id_cliente" required'); ?>
			</div>

			<div class="col-xl-12">




			<div class="col-xl-12 pagamentoTabela">
				<label for="valor" >Serviços: </label>
				<table class="table" >



					<thead>

					 <tr >
									<td>Serviço</td>

									<td>PROFISSIONAL</td>
									<td width="100"> Valor</td>
									<td width="50"> Desc</td>
									<td width="50">  </td>

						<tr >

					</thead>

					<tbody class=" pagamentoTabela" >

						<?php
						$linha = 1;

						if(empty($filtroAgenda)){


						 ?>





							<?php }else{
								$totalAgenda =0;
								foreach ($filtroAgenda as $dadosServAgenda){


									$linha =$linha+$totalAgenda;


									$totalAgenda++;

									$valor= $objServico->ver($dadosServAgenda['id_servico'])['preco_venda'];



									?>


								<tr linha="<?php echo $linha ;?>">
									<td id="targetComboRota" linha="1">
											<?php echo form_hidden('id_agenda[]',$dadosServAgenda['id']);?>

										 <?php


												echo form_dropdown('id_servico_pag[]',$comboServico,$dadosServAgenda['id_servico'],"required='required' readonly='readonly'");


											?>

									</td>

									<td id="targetComboRota"  linha="1">

										 <?php


												echo form_dropdown('id_colaborador_pag[]',$comboColaborador,$dadosServAgenda['id_profissional'],"required='required' readonly='readonly'");

											?>

									</td>
										<td> <?php


												 $atributos = array('name' => 'valor_pag[]','class' => 'valorServ','value' => $valor,'readonly'=>'readonly');



												echo form_input($atributos);

											?>
										</td>
										<td> <?php
												$atributos = array('name' => 'desconto_pag[]','class' => 'descontoServ','value' => 0);

												echo form_input($atributos);

											?>
										</td>

										<td> <button type="button" class="btn btn-default"  > &#xf1eb;</button>  </td>
								</tr>



							<?php } }?>
					 </tbody>
					 <tfoot>

						<tr class="destaque">
						<td colspan="5">
								<button type="button"
								class=" btn-pagamento btn btn-success"
								 url="<?php echo site_url('pagamento/adicionarLinha/'); ?>"
								 linha="<?php echo $linha ;?>" disable> Adicionar Serviço</button>
						</td>
					</tr>
					</tfoot>

					</table>
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
																		'type' => 'number',
																		'max' => '12',
																		'value' => $dadosPagamento['parcelamento']);
																		echo form_input($atributos);
																		?>
			</div>

			<div class="col-xl-4">
							<label for="valorTotal" >Valor: </label>
							<?php $atributos = array(
																					'name' => 'valor',
																					'id' => 'valorTotal',
																					'value' => $dadosPagamento['valor'],
																					'type'=>'number',
																					'required'=>'required');
																					echo form_input($atributos);
																					?>
						</div>


			<div class="col-xl-12">
				<label for="observacoes" >Observações: </label>
				<?php $atributos = array(
																'name' => 'observacoes',
																'id' => 'observacoes',
																'value' => $dadosPagamento['observacoes']
															);
																echo form_textarea($atributos);?>
			</div>



			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>
	</fieldset>

</form>

<script>
calcularTotal();
</script>
