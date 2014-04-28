<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_precincts', 
  'url' => 'precincts/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($precinct, 'getId') ?>

<fieldset id="tv_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $precinct->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($precinct, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('equipment', __('Equipo:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $precinct->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($precinct, 'getEquipment', array ('size' => 80,  'control_name' => 'equipment_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('comment', __('Comentario:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $precinct->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($precinct, 'getComment', array ('size' => 80,  'control_name' => 'comment_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>
