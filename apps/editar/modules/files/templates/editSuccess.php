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
  <?php echo label_for('description', 'Descripcion:', 'class="required" ') ?>
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
  <?php echo label_for('profile', 'Perfil:', 'class="required" ') ?> 

  <div class="content">
    <?php $value = object_select_tag($file, 'getPerfilId', array (
      'related_class' => 'Perfil',
      'control_name' => 'perfil_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('display', 'Visible:', 'class="required" ') ?>
  <div class="content">
    <?php $value = object_checkbox_tag($file, 'getDisplay', array (
      'control_name' => 'display',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id','Idioma:', '') ?>

  <div class="content">
    <?php $value = object_select_tag($file, 'getLanguageId', array (
      'related_class' => 'Language',
      'control_name' => 'language_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('duration', 'Duracion:', 'class="required" ') ?>

  <div class="content" id="durationFile">
    <?php include_partial('duration', array('min' => $file->getDurationMin(), 'seg' => $file->getDurationSeg() )) ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('resolution', 'Resolucion:', 'class="required" ') ?>

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
  <?php echo label_for('size', 'Tama&ntilde;o:', 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($file, 'getSize', array (
      'size' => 27,
      'control_name' => 'size',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('File', 'File:', 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($file, 'getFile', array (
      'size' => 80,
      'control_name' => 'file',
      )); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <?php if (sfConfig::get('app_videoserv_browser')) echo button_to_function('explorar', "Effect.toggle('explorer_master','blind')" )?>
    <div id="explorer_master" class="videoserv" style="display:none;">
      <ul class="videoserv_tree">
        <?php foreach(array('//172.20.209.52/video_tmp3/MASTERS') as $dir):?>
        <li class="collapsed">
          <span onclick="fileServerTree(this, 'file', '<?php echo $dir?>', 0, 'explorer_master')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>   
  </div>
</div>


<div class="form-row">

  <?php echo label_for('url', 'Url:', 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($file, 'getUrl', array (
      'size' => 80,
      'control_name' => 'url',
      )); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <?php if (sfConfig::get('app_videoserv_browser')) echo button_to_function('explorar', "Effect.toggle('explorer_videoserv','blind')" )?>
    <div id="explorer_videoserv" class="videoserv" style="display:none;">
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_videoserv_url') as $dir):?>
        <li class="collapsed">
          <span onclick="fileServerTree(this, 'url', '<?php echo $dir?>', 0, 'explorer_videoserv')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>   
  </div>
</div>




</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
