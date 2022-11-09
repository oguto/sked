
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosCliente['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-12">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosCliente['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="telefone" >Telefone: </label>
				<?php $atributos = array(
                                    'name' => 'telefone',
                                    'id' => 'telefone',
                                    'value' => $dadosCliente['telefone'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="nascimento" >Nascimento: </label>
				<?php $atributos = array(
																		'name' => 'nascimento',
																		'id' => 'nascimento',
																		 'type'=>'date',
																		'value' => $dadosCliente['nascimento'],
																		'required'=>'required');
																		echo form_input($atributos);
																		?>
			</div>
			<div class="col-xl-12">
				<label for="email" >Email: </label>
				<?php $atributos = array(
                                    'name' => 'email',
                                    'id' => 'email',
                                    'value' => $dadosCliente['email'],
                                    'type'=>'email',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>

			<div class="col-xl-6">
				<label for="cep" >Cep: </label>
				<?php $atributos = array(
                                    'name' => 'cep',
                                    'id' => 'cep',
                                    'value' => $dadosCliente['cep'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="numero" >Número: </label>
				<?php $atributos = array(
																		'name' => 'numero',
																		'id' => 'numero',
																		'value' => $dadosCliente['numero'],
																		'required'=>'required');
																		echo form_input($atributos);
																		?>
			</div>

			<div class="col-xl-12">
				<label for="endereco" >Endereço: </label>
				<?php $atributos = array(
                                    'name' => 'endereco',
                                    'id' => 'endereco',
                                    'value' => $dadosCliente['endereco'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>

			<div class="col-xl-12">
				<label for="responsavel" >Responsavel: </label>
				<?php $atributos = array(
                                    'name' => 'responsavel',
                                    'id' => 'responsavel',
                                    'value' => $dadosCliente['responsavel'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-12">
				<label for="contato_responsavel" >Contato responsavel: </label>
				<?php $atributos = array(
                                    'name' => 'contato_responsavel',
                                    'id' => 'contato_responsavel',
                                    'value' => $dadosCliente['contato_responsavel'],
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
