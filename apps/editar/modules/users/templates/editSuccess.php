<?php use_helper('Object', 'Javascript') ?>

<div id="tv_admin_container">
 
<?php echo form_remote_tag(array( 
  'update' => 'list_users', 
  'url' => 'users/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('name', 'Nombre:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($user, 'getName', array ('size' => 33,  'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('login', 'Login:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($user, 'getLogin', array ('size' => 33,  'control_name' => 'login',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_login" style="display:none" class="error">Login vacio</span>  
    </div>
</div>

<div class="form-row">
  <?php echo label_for('passwd', 'Passwd:', 'class="required" ') ?>
  <div class="content">
  <input type="password" size="8" id="passwd" value="<?php echo (($user->isNew())?'':'______')?>" name="passwd" class="MB_focusable"/>
  <?php //$value = object_input_tag($user, 'getPasswd', array ('size' => 8,  'control_name' => 'passwd')); echo $value ? $value : '&nbsp;' ?>
    <span id="error_password" style="display:none" class="error">Password vacio</span>  
    </div>
</div>

<div class="form-row">
  <?php echo label_for('email', 'Email:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($user, 'getEmail', array ('size' => 33,  'control_name' => 'email',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_email" style="display:none" class="error">Formato email no v&aacute;lido</span>  
    </div>
</div>

<div class="form-row">
  <?php echo label_for('type', 'Tipo:', 'class="required" ') ?>
  <div class="content">
    <select name="user_type_id" id="user_type_id" <?php echo($sf_user->getAttribute('user_type_id', 1) == 0?'':' disabled="disabled" ') ?> >
      <option <?php echo (($user->getUserTypeId() == 0)?'selected="selected"':''); ?> value="0">Administrador</option>
      <option <?php echo (($user->getUserTypeId() == 1)?'selected="selected"':''); ?> value="1">Publicador</option>
      <option <?php echo (($user->getUserTypeId() == 2)?'selected="selected"':''); ?> value="2">FTP</option>
    </select>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('root', 'Root:', 'class="required" ') ?>
  <div class="content">
    <?php echo object_checkbox_tag($user, 'getRoot', ($sf_user->getAttribute('user_type_id', 1) == 0?'':' disabled="disabled" ')
    ) ?>
    </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=return comprobar_form_user($("login").value, $("passwd").value, $("email").value)'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
