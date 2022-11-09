
<?php echo $abas;?>
<form action="<?php echo $action ;?>"
	method="post" target="_blank" >

	<?php echo form_hidden('id',$dadosAdmin['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="email" >Email: </label>
				<?php $atributos = array(
                                    'name' => 'email',
                                    'id' => 'email',
                                    'value' => $dadosAdmin['email'],
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
                                    'value' => $dadosAdmin['nome'],
                                    'required'=>'required');
                                    echo form_input($atributos);
                                    ?>
			</div>
			<div class="col-xl-4">
				<label for="data" >Data: </label>
				<?php $atributos = array(
                                    'name' => 'data',
                                    'id' => 'data',
                                    'value' => $dadosAdmin['data'],
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
