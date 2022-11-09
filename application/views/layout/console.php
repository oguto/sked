
<div class="console">


		<?php if(!empty($this->session->flashdata('sucesso'))){ ?>

			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <?php echo $this->session->flashdata('sucesso');?>
			  </div>

		<?php }if(!empty($this->session->flashdata('informacao'))){ ?>

			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <?php echo $this->session->flashdata('informacao');?>
			</div>

		<?php }if(!empty($this->session->flashdata('alerta'))){ ?>

			<div class="alert alert-warning alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <?php echo $this->session->flashdata('alerta');?>
			</div>

		<?php }if(!empty($this->session->flashdata('erro'))){ ?>

			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <?php echo $this->session->flashdata('erro');?>
			</div>

		<?php } ?>

</div>
