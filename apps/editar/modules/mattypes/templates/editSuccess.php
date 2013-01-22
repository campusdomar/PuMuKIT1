<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_mattypes', 
  'url' => 'mattypes/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($mattype, 'getId') ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('type', 'Tipo:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($mattype, 'getType', array ('size' => 3,  'maxlength' => 3, 'control_name' => 'type',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('mime_type', 'Mime Type:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($mattype, 'getMimeType', array ('size' => 25,  'control_name' => 'mimetype',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php $sep =''; foreach ($langs as $lang): ?>
    <?php $mattype->setCulture($lang);  echo $sep ?>  
  
    <?php echo label_for('name_' . $lang, 'Nombre:', 'class="required" ') ?>
    <div class="content">
      <?php $value = object_input_tag($mattype, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
    </div>
  
    <?php $sep='<br />'?>
  <?php endforeach; ?> 
</div>



</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>


