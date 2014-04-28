<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_codecs', 
  'url' => 'codecs/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($codec, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($codec, 'getName', array ('size' => 3, 'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

