<h2><?php echo __('Login') ?></h2>

<?php if($sf_user->hasCredential('pri')): ?>
Usuario Registrado.
<div id="buscar" align="center">
  <form name="form1" method="post" action="<?php echo url_for('utils/logout') ?>">
    <input type="submit" name="Submit" value="Salir" />
  </form>
</div>
<?php else: ?>
<div id="buscar" align="center">
  <form name="form1" method="post" action="<?php echo url_for('utils/login') ?>">
    <input type="text" class="text" value="nombre" name="login" id="login" style="width: 88%; margin:4px 0px; font-size: 85%"/>
    <input type="password" class="text" value="" name="passwd" id="passwd" style="width: 88%; margin:0px 0px 4px; font-size: 85%"/>
    <input type="submit" name="Submit" value="Entrar" />
  </form>
</div>

<?php endif ?>