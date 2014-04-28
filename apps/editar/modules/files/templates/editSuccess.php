<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'files_mms', 
  'url' => 'files/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($file, 'getId') ?>
<input type="hidden" name="mm" id="mm" value="<?php echo $file->getMmId() ?>" />
<input type="hidden" name="preview" id="preview" value="true" />


<fieldset>


<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $file->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($file, 'getDescription', array ('size' => 80,  'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('profile', __('Perfil:'), 'class="required" ') ?> 

  <div class="content">
    <?php $value = object_select_tag($file, 'getPerfilId', array (
      'related_class' => 'Perfil',
      'control_name' => 'perfil_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('display', __('Visible:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_checkbox_tag($file, 'getDisplay', array (
      'control_name' => 'display',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id', __('Idioma:'), '') ?>

  <div class="content">
    <?php $value = object_select_tag($file, 'getLanguageId', array (
      'related_class' => 'Language',
      'control_name' => 'language_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('duration', __('Duración:'), 'class="required" ') ?>

  <div class="content" id="durationFile">
    <?php include_partial('duration', array('min' => $file->getDurationMin(), 'seg' => $file->getDurationSeg() )) ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('resolution', __('Resolución:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($file, 'getResolutionHor', array (
      'size' => 5,
      'control_name' => 'resolutionhor',
    )); echo $value ? $value : '&nbsp;' ?>
    x
    <?php $value = object_input_tag($file, 'getResolutionver', array (
      'size' => 5,
      'control_name' => 'resolutionver',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('size', __('Tama&ntilde;o:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($file, 'getSize', array (
      'size' => 27,
      'control_name' => 'size',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('File', __('File:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($file, 'getFile', array (
      'size' => 80,
      'control_name' => 'file',
      )); echo $value ? $value : '&nbsp;' ?> &nbsp;
  </div>
</div>


<div class="form-row">

  <?php echo label_for('url', __('URL:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($file, 'getUrl', array (
      'size' => 80,
      'control_name' => 'url',
      )); echo $value ? $value : '&nbsp;' ?> &nbsp;
  </div>
</div>




</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
