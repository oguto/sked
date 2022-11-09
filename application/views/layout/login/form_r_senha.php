
<div class="app-cross redefinir">

            <h2><div class="logo"> <img src="<?= base_url() ?>includes/img/logo.png"  ></div> </h2>
    <form  action="<?php echo site_url('login/redefinir') ?>"   class=" login " method="post"  >


          <input type="text"  name="email"  placeholder="E-mail" required="required">

                <div class="submit">
                <input type="submit" onclick="myFunction()" value="Enviar" >
                </div>
                <div class="clear"></div>
                <?php echo $console; ?>
                <h3><a href="<?php echo site_url('login') ?>">Voltar ao Login!</a></h3>






        <?= form_close(); ?>




        </div>
