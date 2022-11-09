
<div class="console">
	<br>

	<div class="col-sm-12">

		<?php if(!empty($this->session->flashdata('msgSucesso'))): ?>

			<div class="alert alert-success " >
			  <?php echo $this->session->flashdata('msgSucesso');?>
			  </div>

		<?php elseif(!empty($this->session->flashdata('msgInformacao'))): ?>

			<div class="alert alert-info " >
			 <?php echo $this->session->flashdata('msgInformacao');?>
			</div>

		<?php elseif(!empty($this->session->flashdata('msgAlerta'))): ?>

			<div class="alert alert-warning " >
			 <?php echo $this->session->flashdata('msgAlerta');?>
			</div>

		<?php elseif(!empty($this->session->flashdata('msgErro'))): ?>

			<div class="alert alert-danger " >
			 <?php echo $this->session->flashdata('msgErro');?>
			</div>

		<?php endif; ?>
	</div>

</div>
