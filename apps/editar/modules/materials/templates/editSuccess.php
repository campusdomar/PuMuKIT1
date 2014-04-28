<?php use_helper('Object', 'Javascript') ?>

<div id="tv_admin_container">

<form method="post" enctype="multipart/form-data" target="iframeUpload" action="<?php echo url_for('materials/upload')?>">
<iframe name="iframeUpload" style="display:none" src=""></iframe>


<?php echo object_input_hidden_tag($material, 'getId') ?>
<input type="hidden" name="mm" id="mm" value="<?php echo $material->getMmId() ?>" />

<fieldset>

<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $material->setCulture($lang);  echo $sep ?>  
        <?php $value = object_input_tag($material, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
        )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('display', __('Visible:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_checkbox_tag($material, 'getDisplay', array (
      'control_name' => 'display',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('mat_type_id', __('Tipo:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_select_tag($material, 'getMatTypeId', array (
								       'related_class' => 'MatType',
								       'control_name' => 'mat_type_id',
								       'include_blank' => false,
								       )); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>



<?php if($material->isNew()):?>
  <div class="form-row">
    <?php echo label_for('file_type', __('Modo:'), 'class="required" ') ?>
  
    <div class="content">
      <input type="radio" name="file_type" value="file" <?php if($default_sel == 'file') echo 'checked="checked"' ?> onclick="$('input_material_url').hide();$('input_material_file').show();"/> <?php echo __('File ')?>
      <input type="radio" name="file_type" id="radio_url" value="url" <?php if($default_sel == 'url') echo 'checked="checked"' ?>  onclick="$('input_material_file').hide();$('input_material_url').show();"/> URL 
    </div>
  </div>
  
  
  <div id="input_material_url" class="form-row"  style="<?php if($default_sel == 'file') echo 'display:none' ?>">
    <?php echo label_for('url', __('URL:'), '') ?>
  
    <div class="content">
      <?php $value = object_input_tag($material, 'getUrl', array (
        'size' => 60,
        'control_name' => 'url',
        )); echo $value ? $value : '&nbsp;' ?>
        <span id="error_url" style="display:none" class="error"><?php echo __('Formato URL no v&aacute;lido')?></span>
    </div>
  </div>
  
  
  <div id="input_material_file" class="form-row" style="<?php if($default_sel == 'url') echo 'display:none' ?>">
    <?php echo label_for('file', __('Archivo:'), '') ?>
    
    <div class="content">
      <?php echo input_file_tag('file', 'size=50') ?>
        <span id="error_file" style="display:none" class="error"><?php echo __('Campo file vacío')?></span>
    </div>
  </div>

<?php else:?>
  <div id="input_material_url" class="form-row"  style="<?php if($default_sel == 'file') echo 'display:none' ?>">
    <?php echo label_for('url', __('URL:'), '') ?>
  
    <div class="content">
      <?php $value = object_input_tag($material, 'getUrl', array (
        'size' => 60,
        'control_name' => 'url',
        'disabled' => 'true',
        )); echo $value ? $value : '&nbsp;' ?>
    </div>
  </div>
<?php endif?>

</fieldset>


<ul class="tv_admin_actions">
<?php if($material->isNew()):?>
  <li>
    <?php echo submit_tag(__('OK'),array('name' => 'OK', 'class' => 'tv_admin_action_save', 
				     'onclick' => 'if($("radio_url").checked) {
                                                     return comprobar_form_url($("url").value)
                                                   } else {
                                                     return comprobar_form_file_nmb($("file").value)
                                                   }'
				     )) ?>   
  </li>
<?php else: ?>
  <li><?php echo submit_tag(__('OK'),array('name' => 'OK', 'class' => 'tv_admin_action_save')) ?>   </li>
<?php endif ?>

  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
