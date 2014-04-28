<?php use_helper('Object') ?>


<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_streamservs', 
  'url' => 'streamservs/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($streamserv, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($streamserv, 'getName', array ('size' => 80,  'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('ip', __('IP:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($streamserv, 'getIp', array ('size' => 15,  'control_name' => 'ip',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_ip" style="display:none" class="error"><?php echo __('Formato IP no v&aacute;lido')?></span>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('type', __('Tipo:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_select_tag($streamserv, 'getStreamserverTypeId', array (
        'related_class' => 'StreamserverType',
        'control_name' => 'streamserver_type_id',
        'include_blank' => false,
	'size' => '1',
      )); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_textarea_tag($streamserv, 'getDescription', array (
      'size' => '80x4',
        'control_name' => 'description',
    )); echo $value ? $value : '&nbsp;' ?>

  </div>
</div>

<div class="form-row">
  <?php echo label_for('dir_out', __('Path OUT:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($streamserv, 'getDirOut', array ('size' => 80,  'control_name' => 'dir_out',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('url_out', __('URL OUT:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($streamserv, 'getUrlOut', array ('size' => 80,  'control_name' => 'url_out',
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

