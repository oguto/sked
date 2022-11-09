
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosColaborador['id']);?>

	<fieldset>
		<div class="form-group">

			<div class="col-xl-12">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosColaborador['nome'],
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
                                    'value' => $dadosColaborador['nascimento'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="cpf" >Cpf: </label>
				<?php $atributos = array(
                                    'name' => 'cpf',
                                    'id' => 'cpf',
                                    'value' => $dadosColaborador['cpf'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-12">
				<label for="email" >Email: </label>
				<?php $atributos = array(
																		'name' => 'email',
																		'id' => 'email',
																		'value' => $dadosColaborador['email'],
																		'type'=>'email',
																		'required'=>'required');
																		echo form_input($atributos);
																		?>
			</div>
			<div class="col-xl-6">
				<label for="telefone" >Telefone: </label>
				<?php $atributos = array(
                                    'name' => 'telefone',
                                    'id' => 'telefone',
                                    'value' => $dadosColaborador['telefone'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="cep" >Cep: </label>
				<?php $atributos = array(
                                    'name' => 'cep',
                                    'id' => 'cep',
                                    'value' => $dadosColaborador['cep'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-6">
				<label for="numero" >Número: </label>
				<?php $atributos = array(
                                    'name' => 'numero',
                                    'id' => 'numero',
                                    'value' => $dadosColaborador['numero'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>


			<div class="col-xl-6">
				<label for="comissao" >Comissão: </label>
				<?php $atributos = array(
                                    'name' => 'comissao',
                                    'id' => 'comissao',
																		'type'=>'number',
                                    'value' => $dadosColaborador['comissao'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-12">
				<label for="endereco" >Endereço: </label>
				<?php $atributos = array(
																		'name' => 'endereco',
																		'id' => 'endereco',
																		'value' => $dadosColaborador['endereco'],
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
