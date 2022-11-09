
<div class="app-cross">
<h2>
    <div class="logo">
        <img src="../includes/img/logo.png">
    </div>
</h2>
<form  action="<?php echo site_url('login') ?>"   class=" login " method="post"  >
    <?php echo $console; ?>
    <input type="hidden"  name="chave"  value="teste">
    <label for="email">Email</label>
    <input type="text" class="text" name="email" id="email" placeholder="E-mail"  required="required" >
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha"  placeholder="Senha"  required="required">
    <div class="submit">
        <input type="submit" onclick="myFunction()" value="Entrar" >
    </div>
    <div class="clear"></div>
    <h3>
        <a href="<?php echo site_url('login/redefinir') ?>">Esqueceu a sua senha?</a>
    </h3>
<?= form_close(); ?>
</div>
