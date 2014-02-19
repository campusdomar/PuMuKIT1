<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_timeframes', 
  'url' => 'timeframes/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($timeframe, 'getId') ?>
<?php echo __('Editar timeframe')?>
  
  <div id="remember_save_mm" style="display: none; position: absolute; color:red; border: 1px solid red; padding: 5px; background-color:#fdc; font-weight:bold;">
    <?php echo __('Pulse OK para que el cambio tenga efecto')?>
  </div>

<fieldset>

<div class="form-row">
  <?php echo label_for('category_id', 'category_id:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($timeframe, 'getCategoryId', array ( 'size' => 4, 'control_name' => 'category_id',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('mm_id', 'mm_id:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($timeframe, 'getMmId', array ('size' => 4,  'control_name' => 'mm_id',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('timestart', 'Fecha de Comienzo:', 'class="required long" ') ?>
  <div class="content content_long">
  <?php $value = object_input_date_tag($timeframe, 'getTimestart', array (
    'rich' => true,
    'withtime' => true,
    'calendar_button_img' => '/images/admin/buttons/date.png',
    'control_name' => 'timestart'
    // ,'onchange' => "$('remember_save_serial').show()"
)); echo $value ? $value : '&nbsp;' ?>
    </div>
    <span id="error_date1" style="display:none" class="error">Formato de fecha no v&aacute;lido</span> 
</div>

<div class="form-row">
  <?php echo label_for('timeend', 'Fecha de Final:', 'class="required long" ') ?>
  <div class="content content_long">
  <?php $value = object_input_date_tag($timeframe, 'getTimeend', array (
    'rich' => true,
    'withtime' => true,
    'calendar_button_img' => '/images/admin/buttons/date.png',
    'control_name' => 'timeend'
    // ,'onchange' => "$('remember_save_serial').show()"
)); echo $value ? $value : '&nbsp;' ?>
    </div>
    <span id="error_date2" style="display:none" class="error">Formato de fecha no v&aacute;
</div>

<div class="form-row">
  <?php echo label_for('description', 'Descripción:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($timeframe, 'getDescription', array ('size' => 80,  'control_name' => 'description',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

</fieldset>

<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=if(comprobar_form_mm($("timestart").value, $("timeend").value, '. get_js_regexp_timedate($sf_user->getCulture()) . ')){$(\'remember_save_mm\').hide(); Modalbox.hide();}else{return false}'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>
</form>
</div>