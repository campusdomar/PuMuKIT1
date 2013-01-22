<?php use_helper('Object', 'Javascript') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_resolutions', 
  'url' => 'resolutions/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($resolution, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('hor', 'Horizontal:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($resolution, 'getHor', array ('size' => 3,  'control_name' => 'hor',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('ver', 'Vertical:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($resolution, 'getVer', array ('size' => 3,  'control_name' => 'ver',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>




</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>

