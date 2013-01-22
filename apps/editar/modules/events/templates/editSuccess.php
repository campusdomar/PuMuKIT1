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
  <?php echo label_for('name', 'Evento:', 'class="required" ') ?>
  <div class="content">
      <?php echo object_input_tag($event, 'getName', array (
        'size' => '80',
        'control_name' => 'name',
      )); ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('place', 'Lugar:', 'class="required" ') ?>
  <div class="content">
      <?php echo object_input_tag($event, 'getPlace', array (
        'size' => '80',
        'control_name' => 'place',
      )); ?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('direct_id','Canal:', 'class="required"') ?>
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
  <?php echo label_for('date', 'Horario:', 'class="required" ') ?>
  <div class="content">
    Fecha: 
    <?php echo object_input_date_tag($event, 'getDate', array (
      'rich' => true,
      'withtime' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'date',
    )) ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Duracion(min):
    <?php echo object_input_tag($event, 'getDuration', array (
      'control_name' => 'duration',
    )) ?>
    <span id="error_date" style="display:none" class="error">Formato fecha no v&aacute;lido</span>
    <span id="error_duration" style="display:none" class="error">La duracion tiene que ser un valor numerico</span>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('display', 'Anunciar:', 'class="required" ') ?>
  <div class="content">
    <?php echo object_checkbox_tag($event, 'getDisplay', array (
  	// 'onchange' => 'submit()',
    )) ?>
    </div>
</div>





</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=return comprobar_form_event($("date").value, '. get_js_regexp_timedate($sf_user->getCulture()) . ', $("duration").value)'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

