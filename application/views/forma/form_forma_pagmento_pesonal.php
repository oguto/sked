
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosFormaPagmentoPesonal['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="id_forma_pagamento" >Forma pagamento: </label>
				<?php  echo form_dropdown(
                'id_forma_pagamento',
                $comboFormaPagmento,
                $dadosFormaPagmentoPesonal['id_forma_pagamento'],
                'name="id_forma_pagamento" id="id_forma_pagamento" required'); ?>
			</div>
			<div class="col-xl-4">
				<label for="descricao" >Descrição: </label>
				<?php $atributos = array(
                            'name' => 'descricao',
                            'id' => 'descricao',
                            'value' => $dadosFormaPagmentoPesonal['descricao'],
                            'class'=>'tinymce',
                            'required'=>'required');
                            echo form_textarea($atributos);?>
			</div>
			<div class="col-xl-4">
				<label for="id_loja" >Loja: </label>
				<?php  echo form_dropdown(
                'id_loja',
                $comboPersonal,
                $dadosFormaPagmentoPesonal['id_loja'],
                'name="id_loja" id="id_loja" required'); ?>
			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>    
	</fieldset>
	
</form>