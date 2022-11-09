
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosColaborador['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="email" >Email: </label>
				<?php $atributos = array(
                                    'name' => 'email',
                                    'id' => 'email',
                                    'value' => $dadosColaborador['email'],
                                    'type'=>'mail',
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                                    'name' => 'nome',
                                    'id' => 'nome',
                                    'value' => $dadosColaborador['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="nascimento" >Nascimento: </label>
				<?php $atributos = array(
                                    'name' => 'nascimento',
                                    'id' => 'nascimento',
                                    'value' => $dadosColaborador['nascimento'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="cpf" >Cpf: </label>
				<?php $atributos = array(
                                    'name' => 'cpf',
                                    'id' => 'cpf',
                                    'value' => $dadosColaborador['cpf'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="telefone" >Telefone: </label>
				<?php $atributos = array(
                                    'name' => 'telefone',
                                    'id' => 'telefone',
                                    'value' => $dadosColaborador['telefone'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="cep" >Cep: </label>
				<?php $atributos = array(
                                    'name' => 'cep',
                                    'id' => 'cep',
                                    'value' => $dadosColaborador['cep'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="numero" >Número: </label>
				<?php $atributos = array(
                                    'name' => 'numero',
                                    'id' => 'numero',
                                    'value' => $dadosColaborador['numero'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="responsavel" >Responsavel: </label>
				<?php $atributos = array(
                                    'name' => 'responsavel',
                                    'id' => 'responsavel',
                                    'value' => $dadosColaborador['responsavel'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="endereco" >Endereço: </label>
				<?php $atributos = array(
                                    'name' => 'endereco',
                                    'id' => 'endereco',
                                    'value' => $dadosColaborador['endereco'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="comissao" >Comissão: </label>
				<?php $atributos = array(
                                    'name' => 'comissao',
                                    'id' => 'comissao',
                                    'value' => $dadosColaborador['comissao'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosColaborador['data'],
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
