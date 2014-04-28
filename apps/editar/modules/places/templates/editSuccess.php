<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_places', 
  'url' => 'places/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($place, 'getId') ?>

<fieldset id="tv_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('cod', __('Siglas:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($place, 'getCod', array ('size' => 10,
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('coorgeo', __('Coordenadas geo.:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($place, 'getCoorgeo', array ('size' => 45,
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_coorgeo" style="display:none" class="error"><?php echo __('Formato coordenadas no v&aacute;lido')?></span>  
  </div>
</div>


<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $place->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($place, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('address', __('Dirección:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $place->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($place, 'getAddress', array ('size' => 80,  'control_name' => 'address_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_place($("coorgeo").value)'); ?></li>
<li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>
