
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>"
	destino="<?php echo $destino;?>"
	modal="<?php echo $modal ;?>"
	class=" enviaform"
	method="post" >

	<?php echo form_hidden('id',$dadosUsuario['id']);?>

	<fieldset>
		<?php echo  $console; ?>

		<div class="form-group">

			<div class="col-xl-12">
			<label for="grupo" >Grupo: </label>
			<?php  echo form_dropdown(
									'grupo',
									$comboGrupo,
									$dadosUsuario['grupo'],
									'name="grupo" id="grupo" required'); ?>
		</div>
			<div class="col-xl-4">
				<label for="nome" >Nome: </label>
				<?php $atributos = array(
                            'name' => 'nome',
                            'id' => 'nome',
                            'value' => $dadosUsuario['nome'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="email" >Email: </label>
				<?php $atributos = array(
                            'name' => 'email',
                            'id' => 'email',
                            'value' => $dadosUsuario['email'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="senha" >Senha: </label>
				<?php $atributos = array(
                            'name' => 'senha',
                            'id' => 'senha'
                          );
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
