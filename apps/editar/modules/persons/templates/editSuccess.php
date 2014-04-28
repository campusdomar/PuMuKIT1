<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => $update, 
  'url' => $sf_data->getRaw('url'),
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($person, 'getId') ?>
<?php if (isset($rol_id)) echo input_hidden_tag('rol_id', $rol_id) ?>
<?php if (isset($mm_id)) echo input_hidden_tag('mm_id', $mm_id) ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('honorific', __('Honores:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $person->setCulture($lang);  echo $sep ?>  
      <?php $value = object_input_tag($person, 'getHonorific', array ('size' => 15,  'control_name' => 'honorific_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($person, 'getName', array ('size' => 80,  'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('post', __('Puesto:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $person->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($person, 'getPost', array ('size' => 80,  'control_name' => 'post_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('firm', __('Empresa:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $person->setCulture($lang);  echo $sep ?>  
 
      <?php $value = object_input_tag($person, 'getFirm', array ('size' => 80,  'control_name' => 'firm_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('bio_' . $lang, __('Bio.:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $person->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($person, 'getBio', array ('size' => 80,  'control_name' => 'bio_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('email', __('Email:'), 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($person, 'getEmail', array (
  'size' => 30,
  'control_name' => 'email',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_email" style="display:none" class="error"><?php echo __('Formato email no v&aacute;lido')?></span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('web', __('Web:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($person, 'getWeb', array (
      'size' => 50,
      'control_name' => 'web',
      )); echo $value ? $value : '&nbsp;' ?>
    <span id="error_url" style="display:none" class="error"><?php echo __('Formato URL no v&aacute;lido')?></span>  
    </div>
</div>

<div class="form-row">
  <?php echo label_for('phone', __('Tel&eacute;fono:'), 'class="required" ') ?>
  <div class="content">

  <?php $value = object_input_tag($person, 'getPhone', array (
    'size' => 30,
    'control_name' => 'phone',
  )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_person($("email").value, $("web").value)'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>