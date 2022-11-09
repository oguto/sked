
<div class="app-cross">

            <h2><div class="logo"> <img src="<?= base_url() ?>includes/img/logo.png"  ></div> </h2>
    <form  action="<?php echo site_url('login/alterarSenha') ?>"   class=" login " method="post"  >

     <input type="hidden" name="user_token" value="<?php echo $token; ?>">
     <label for="senha">Senha</label>


        <input type="password" name="senha1"   placeholder="Digite a nova senha" required="required">
        <label for="senha">repetir Senha</label>


          <input type="password"  name="senha2"  placeholder="Digite novamente" required="required">

                <div class="submit">
                <input type="submit" onclick="myFunction()" value="Enviar" >
                </div>
                <?php echo $console; ?>
                <div class="clear"></div>






        <?= form_close(); ?>


        </div>
