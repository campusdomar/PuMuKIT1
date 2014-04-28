<?php use_helper('Object') ?>


<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_cpus', 
  'url' => 'cpus/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($cpu, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('ip', __('IP:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($cpu, 'getIp', array ('size' => 15,  'control_name' => 'ip',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_ip" style="display:none" class="error"><?php echo __('Formato IP no v&aacute;lido')?></span>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('type', __('Tipo:'), 'class="required" ') ?>
  <div class="content">
    <select size="1" id="cpu_type" name="type">
      <option <?php echo (($cpu->getType() == "windows")?'selected="selected"':'')?> value="windows"><?php echo __('Windows')?></option>
      <option <?php echo (($cpu->getType() == "linux")?'selected="selected"':'')?> value="linux"><?php echo __('Linux')?></option>
    </select>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('min', __('Mínimo:'), 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($cpu, 'getMin', array ('size' => 2,  'control_name' => 'min',
)); echo $value ? $value : '&nbsp;' ?>
  <span id="error_min_negativo" style="display:none" class="error"><?php echo __('Introduzca valor mínimo mayor o igual a cero')?></span>
  <span id="error_min_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('max', __('Máximo:'), 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($cpu, 'getMax', array ('size' => 2,  'control_name' => 'max',
)); echo $value ? $value : '&nbsp;' ?>
  <span id="error_max" style="display:none" class="error"><?php echo __('Introduzca máximo mayor que mínimo')?></span>
  <span id="error_max_negativo" style="display:none" class="error"><?php echo __('Introduzca valor máximo mayor o igual a cero')?></span>
  <span id="error_max_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
    </div>
</div>


<?php $active = $cpu->isActive() ?>
<div class="form-row">
  <?php echo label_for('number', __('Número:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($cpu, 'getNumber', array ('size' => 2,  'control_name' => 'number', 'disabled' => !$active&&!$cpu->isNew(),
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_num_negativo" style="display:none" class="error"><?php echo __('Introduzca valor de número mayor o igual a cero')?></span>
    <span id="error_num_inf" style="display:none" class="error"><?php echo __('Introduzca valor de número superior o igual a valor mínimo')?></span>
    <span id="error_num_sup" style="display:none" class="error"><?php echo __('Introduzca valor de número inferior o igual a valor máximo')?></span>
    <span id="error_num_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
    <?php echo ($active||$cpu->isNew())?'':'<span class="error">' .  __('Equipo no activo'). '</span>'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('user', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($cpu, 'getUser', array ('size' => 20,  'control_name' => 'user',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('password', __('Password:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($cpu, 'getPassword', array ('size' => 20,  'control_name' => 'password',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $cpu->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($cpu, 'getDescription', array (
        'size' => '80x4',
        'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_cpu($("ip").value, $("min").value, $("max").value,$("number").value)'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

