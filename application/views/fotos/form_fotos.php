
<?php echo $abas;?>
<form data-action="<?php echo $action ;?>"
	load="<?php echo $target ;?>" 
	destino="<?php echo $destino;?>" 
	modal="<?php echo $modal ;?>" 
	class=" enviaform" 
	method="post" >

	<?php echo form_hidden('id',$dadosFotos['id']);?>

	<fieldset>
		<div class="form-group">
			<div class="col-xl-4">
				<label for="foto" >Foto: </label>
				<?php echo form_hidden('foto',$dadosFotos['foto']);?>
                            <ul style='width:100%; padding: 0px;'>
                            <li class='imgForm' style='<?php if(empty(!$dadosFotos['foto'])){  echo 'background-image: url('.$dadosFotos['foto'].')';}?>'>
                            <canvas id='canvas' style='display: none;'></canvas>
                            <button type='button' class=' girar' style='display: none;'> &#xf1d4; girar</button>
                            </li>
                            <li class='imputFile'>
                            <label for='foto'>Selecione uma foto</label>
                            <?php
                            $atributos = array('type' =>'file',
                            'onchange' => 'encodeImagetoBase64(this)',
                            'id'=>'foto',
                            'accept'=>'.jpeg,.jpg,.png,.gif');
                            echo form_input($atributos);
                            ?>
                            </li>
                            </ul>
			</div>
			<div class="col-xl-4">
				<label for="descricao" >Descrição: </label>
				<?php $atributos = array(   
                            'name' => 'descricao',
                            'id' => 'descricao',
                            'value' => $dadosFotos['descricao'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
			</div>
			<div class="col-xl-4">
				<label for="id_personal" >Personal: </label>
				<?php  echo form_dropdown(
                'id_personal',
                $comboPersonal,
                $dadosFotos['id_personal'],
                'name="id_personal" id="id_personal" required'); ?>
			</div>
			</div>

		<div class="botaoForm">
			<button type="button" data-dismiss="modal" class=" btn btn-danger ">&#xf129; Cancelar</button>
			<button type="submit" class=" btn btn-info" >&#xf121; Salvar</button>
		</div>    
	</fieldset>
	
</form>