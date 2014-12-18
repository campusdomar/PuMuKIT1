<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_events', 
  'url' => 'events/updateseveral'. $div,
  'script' => 'true',  
)) ?>

<?php echo object_input_hidden_tag($event, 'getId') ?>


<fieldset>



<div class="form-row">
  <?php echo label_for('date', 'Periodo:', 'class="required" ') ?>
  <div class="content">
    Desde: 
    <?php echo object_input_date_tag($event, 'getDate', array (
      'rich' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'from',
    )) ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Hasta:
    <?php echo object_input_date_tag($event, 'getDate', array (
      'rich' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'to',
    )) ?>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="checkbox" id="weekend" value="1" name="weekend" /> Incluir fin de semana
    <span id="error_date" style="display:none" class="error">Formato fecha no v&aacute;lido</span>
  </div>
</div>


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
    Hora de Inicio: 
    <?php echo object_input_tag($event, 'getDuration', array (
      'control_name' => 'hour',
    )); ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Duracion(min):
    <?php echo object_input_tag($event, 'getDuration', array (
      'control_name' => 'duration',
    )) ?>
    <span id="error_hour" style="display:none" class="error">El formato de la hora de inicio es HH:mm</span>
    <span id="error_duration" style="display:none" class="error">La duracion tiene que ser un valor numerico</span>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('display', 'Oculto:', 'class="required" ') ?>
  <div class="content">
    <?php echo object_checkbox_tag($event, 'getDisplay', array (
  	// 'onchange' => 'submit()',
    )) ?>
    </div>
</div>





</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=return comprobar_form_event_several($("from").value, $("to").value, '. get_js_regexp_date($sf_user->getCulture()) . ', $("hour").value, $("duration").value)'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

