<?php use_helper('Object') ?>


<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_profiles', 
  'url' => 'profiles/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($profile, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('Name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($profile, 'getName', array ('size' => 15,  'control_name' => 'name',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('Display', __('Variables:'), 'class="required" ') ?>
  <div class="content">
      <?php echo __('Publicaci&oacute;n(diplay):')?>
      <?php $value = object_checkbox_tag($profile, 'getDisplay', array (
      'control_name' => 'display',
    )); echo $value ? $value : '&nbsp;' ?>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Producci&oacute;n (wizard):')?>
    <?php $value = object_checkbox_tag($profile, 'getWizard', array (
      'control_name' => 'wizard',
    )); echo $value ? $value : '&nbsp;' ?>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Master:')?>
    <?php $value = object_checkbox_tag($profile, 'getMaster', array (
      'control_name' => 'master',
    )); echo $value ? $value : '&nbsp;' ?>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Servidor:')?>
    <?php $value = object_select_tag($profile, 'getStreamserverId', array (
        'related_class' => 'Streamserver',
        'control_name' => 'streamserver_id',
        'include_blank' => false,
	'size' => '1'
      )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('Datos', __('Datos:'), 'class="required" ') ?>
  <div class="content">
    <?php echo __('Formato:')?>
    <?php $value = object_input_tag($profile, 'getFormat', array ('size' => 4,  'control_name' => 'format',
)); echo $value ? $value : '&nbsp;' ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Códec:')?>
    <?php $value = object_input_tag($profile, 'getCodec', array ('size' => 4,  'control_name' => 'codec',
)); echo $value ? $value : '&nbsp;' ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('MIME type:')?>
    <?php $value = object_input_tag($profile, 'getMimeType', array ('size' => 12,  'control_name' => 'mimetype',
)); echo $value ? $value : '&nbsp;' ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Extensión:')?>
    <?php $value = object_input_tag($profile, 'getExtension', array ('size' => 3, 'maxlength' => 3, 'control_name' => 'extension',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('Bitrate', __('Des. Técnicas:'), 'class="required" ') ?>
  <div class="content">
    <?php echo __('Resoluci&oacute;n:')?>
    <?php $value = object_input_tag($profile, 'getResolutionHor', array ('size' => 4,  'control_name' => 'resolutionhor',
)); echo $value ? $value : '&nbsp;' ?>&nbsp;x
    <?php $value = object_input_tag($profile, 'getResolutionVer', array ('size' => 4,  'control_name' => 'resolutionver',
)); echo $value ? $value : '&nbsp;' ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Bitrate:')?>
    <?php $value = object_input_tag($profile, 'getBitrate', array ('size' => 10,  'control_name' => 'bitrate',
)); echo $value ? $value : '&nbsp;' ?> 
    <span id="error_bitrare_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Framerate:')?>
    <?php $value = object_input_tag($profile, 'getFramerate', array ('size' => 10,  'control_name' => 'framerate',
)); echo $value ? $value : '&nbsp;' ?>
    <span id="error_framerate_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
    <span id="error_resolution_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('Audio', __('Audio:'), 'class="required" ') ?>
  <div class="content">
      <?php echo __('Solo audio:')?>
      <?php $value = object_checkbox_tag($profile, 'getAudio', array (
      'control_name' => 'audio',
    )); echo $value ? $value : '&nbsp;' ?>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo __('Canales:')?>
     <?php $value = object_input_tag($profile, 'getChannels', array ('size' => 2,  'control_name' => 'channels',
)); echo $value ? $value : '&nbsp;' ?>
     <span id="error_channels_no_num" style="display:none" class="error"><?php echo __('Introduzca un número')?></span>      
  </div>
</div>


<div class="form-row">
  <?php echo label_for('link', __('Link Text:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $profile->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($profile, 'getLink', array (
        'size' => '35',
        'control_name' => 'link_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $profile->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($profile, 'getDescription', array (
        'size' => '80x1',
        'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

  <?php if(sfConfig::get('app_transcoder_use')):?>
<div class="form-row">
  <?php echo label_for('Bat', __('Bat:'), 'class="required" ') ?>
  <div class="content">
       <?php $value = object_textarea_tag($profile, 'getBat', array ('style' => 'width:90%',  'control_name' => 'bat', 'size' => '80x1'
)); echo $value ? $value : '&nbsp;' ?>&nbsp; <a href="#" onclick="$('error_ayuda').show(); return false">?</a> 
    <div id="error_ayuda" style="display:none">
      <span style="font-weight: bold">%1:</span> <?php echo __('vídeo entrada')?> 
      <span style="font-weight: bold">| %2: </span><?php echo __('vídeo salida')?> 
      <span style="font-weight: bold">| %3:</span><?php echo __('fichero configuración')?>
      <span style="font-weight: bold">| %_{1-9}:</span><?php echo __('ficheros temporales')?>
    </div>   
  </div>
</div>

<div class="form-row">
  <?php echo label_for('Filecfg', __('Fichero Cfg:'), 'class="required" ') ?>
  <div class="content">
     <?php $value = object_input_tag($profile, 'getFileCfg', array ('size' => 60,  
								    'control_name' => 'filecfg')); 
           echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('prescript', __('Pre-Script\n(AVISYNTH):'), 'class="required" ') ?>
  <div class="content">
     <?php $value = object_textarea_tag($profile, 'getPrescript', array (
									 'size' => '80x2',  
									 'control_name' => 'prescript')
					); 
           echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('App', __('Aplicación:'), 'class="required" ') ?>
  <div class="content">
       <?php $value = object_input_tag($profile, 'getApp', array ('size' => 15,  'control_name' => 'app',
)); echo $value ? $value : '&nbsp;' ?>    
  </div>
</div>


<div class="form-row">
  <?php echo label_for('out', __('Relaciones:'), 'class="required" ') ?>
  <div class="content">
       <?php echo __('Duraci&oacute;n/tama&ntilde;o:')?>
       <?php $value = object_input_tag($profile, 'getRelDurationSize', array ('size' => 15,  'control_name' => 'rel_duration_size',
								     )); echo $value ? $value : '&nbsp;' ?>    
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <?php echo __('Duraci&oacute;n/transcodificaci&oacute;n:')?>
       <?php $value = object_input_tag($profile, 'getRelDurationTrans', array ('size' => 15,  'control_name' => 'rel_duration_trans',
								     )); echo $value ? $value : '&nbsp;' ?>    
  </div>
</div>

<?php endif ?>

</fieldset>

<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_profile($("channels").value, $("framerate").value, $("resolutionhor").value,$("resolutionver").value)'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

