<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_events', 
  'url' => 'events/update'. $div,
  'script' => 'true',  
)) ?>

<?php echo object_input_hidden_tag($event, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('name', __('Evento:'), 'class="required" ') ?>
  <div class="content">
      <?php echo object_input_tag($event, 'getName', array (
        'size' => '80',
        'control_name' => 'name',
      )); ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('place', __('Lugar:'), 'class="required" ') ?>
  <div class="content">
      <?php echo object_input_tag($event, 'getPlace', array (
        'size' => '80',
        'control_name' => 'place',
      )); ?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('direct_id', __('Canal:'), 'class="required"') ?>
  <div class="content">
    <?php $value = object_select_tag($event, 'getDirectId', array (
      'related_class' => 'Direct',
      'control_name' => 'direct_id',
      'peer_method' => 'doSelectWithI18n',
      'include_blank' => true,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('date', __('Horario:'), 'class="required" ') ?>
  <div class="content">
    <?php echo __('Fecha:')?> 
    <?php echo object_input_date_tag($event, 'getDate', array (
      'rich' => true,
      'withtime' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'date',
    )) ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Duración(min):')?>
    <?php echo object_input_tag($event, 'getDuration', array (
      'control_name' => 'duration',
    )) ?>
    <span id="error_date" style="display:none" class="error"><?php echo __('Formato fecha no v&aacute;lido')?></span>
    <span id="error_duration" style="display:none" class="error"><?php echo __('La duración tiene que ser un valor numérico')?></span>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('display', __('Anunciar:'), 'class="required" ') ?>
  <div class="content">
    <?php echo object_checkbox_tag($event, 'getDisplay', array (
  	// 'onchange' => 'submit()',
    )) ?>
    </div>
</div>





</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_event($("date").value, '. get_js_regexp_timedate($sf_user->getCulture()) . ', $("duration").value)'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

