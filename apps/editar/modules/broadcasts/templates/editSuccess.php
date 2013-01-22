<?php use_helper('Object') ?>

<div id="tv_admin_container">
 
<?php echo form_remote_tag(array( 
  'update' => 'list_broadcasts', 
  'url' => 'broadcasts/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($broadcast, 'getId') ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('name', 'Nombre:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($broadcast, 'getName', array ('size' => 3,  'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('type', 'Tipo:', 'class="required" ') ?>
  <div class="content">
    <?php $value = object_select_tag($broadcast, 'getBroadcastTypeId', array (
        'related_class' => 'BroadcastType',
        'control_name' => 'broadcast_type_id',
        'include_blank' => false,
	'size' => '1'
      )); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('passwd', 'Passwd:', 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($broadcast, 'getPasswd', array ('size' => 12,  'control_name' => 'passwd', 'maxlength' => 12, 
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('description', 'Descripci&oacute;n:', 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $broadcast->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($broadcast, 'getDescription', array ('size' => 80,  'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>
