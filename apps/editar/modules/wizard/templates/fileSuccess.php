<?php use_helper('Object') ?>

<div id="tv_admin_container">

<form method="post" enctype="multipart/form-data" target="iframeUpload" action="<?php echo url_for('wizard/end')?>">
<iframe name="iframeUpload" style="display:none" src=""></iframe>

<!--
<?php echo form_remote_tag(array( 
  'update' => $div, 
  'url' => 'wizard/end',
  'script' => 'true',
)) ?>
-->

<input type="hidden" name="div" value="<?php echo $div?>" />
<input type="hidden" name="serial_id" value="<?php echo $serial->getId()?>" />

<?php foreach ($langs as $lang): $serial->setCulture($lang)?>
  <input type="hidden" name="serial_title_<?php echo $lang?>" value="<?php echo $serial->getTitle()?>" />
  <input type="hidden" name="serial_subtitle_<?php echo $lang?>" value="<?php echo $serial->getSubtitle()?>" />
<?php endforeach ?>


<?php foreach ($langs as $lang): $mm->setCulture($lang)?>
  <input type="hidden" name="mm_title_<?php echo $lang?>" value="<?php echo $mm->getTitle()?>" />
  <input type="hidden" name="mm_subtitle_<?php echo $lang?>" value="<?php echo $mm->getSubtitle()?>" />
  <input type="hidden" name="mm_description_<?php echo $lang?>" value="<?php echo $mm->getDescription()?>" />
  <input type="hidden" name="mm_subserialtitle_<?php echo $lang?>" value="<?php echo $mm->getSubserialTitle()?>" />

<?php endforeach ?>


<fieldset>



<!-- tendria que ser un radio button -->
<div class="form-row">
  <?php echo label_for('profile_id','Master:', 'class="required" ') ?>
  <!-- TODO poner automatico -->
  <div class="content" style="overflow: hidden">
    <?php echo (count($profiles) == 0?"&nbsp;":"") ?>
    <?php foreach($profiles as $profile): ?>
      <span style="display: block; float: left; width: 30%; overflow: hidden">
      <?php echo radiobutton_tag('master', $profile->getId(), 1) ?> <?php echo $profile->getName()?>
      </span>
    <?php endforeach?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('pub_channel_id','Canales de Pub.:', 'class="required" ') ?>

  <div class="content" style="overflow: hidden">
    <?php echo (count($pub_channels) == 0?"&nbsp;":"") ?>
    <?php foreach($pub_channels as $pub_channel): ?>
      <?php if($pub_channel->getEnable() == 0):?>
        <span style="display: block; float: left; width: 30%; overflow: hidden; color: grey">
          <input type="checkbox" disabled="disabled" />  <?php echo $pub_channel->getName()?>
        </span>
      <?php else:?>
        <span style="display: block; float: left; width: 30%; overflow: hidden">
          <?php echo checkbox_tag('pub_channel[]', $pub_channel->getId(), $pub_channel->getDefaultSel()) ?> <?php echo $pub_channel->getName()?>
        </span>
      <?php endif ?>
    <?php endforeach?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('priority','Prioridad:', 'class="required" ') ?>

  <div class="content">
    <input type="radio" value="1" name="prioridad"/> Low-Priority&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" checked="checked" value="2" name="prioridad"/> Normal-Priority&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="3" name="prioridad"/> High-Priority&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id','Idioma:', 'class="required" ') ?>

  <div class="content">
    <?php echo select_tag('idioma', objects_for_select(
      LanguagePeer::doSelect(new Criteria()),
      'getId',
      '__toString',
      LanguagePeer::getDefaultSelId()
    )) ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('file_type', 'Modo:', 'class="required" ') ?>
  
  <div class="content">
    <input type="radio" name="file_type" value="file" checked="checked" onclick="$('input_trans_file').hide();$('input_trans_dir').hide();$('input_trans_url').show();"/> Archivo Local  
    <input type="radio" name="file_type" value="url" onclick="$('input_trans_url').hide();$('input_trans_dir').hide();$('input_trans_file').show();"/> Archivo de Servidor
    <input type="radio" name="file_type" value="dir" onclick="$('input_trans_url').hide();$('input_trans_file').hide();$('input_trans_dir').show();"/> Directorio entero del servidor
  </div>
</div>

<div class="form-row" id="input_trans_url">

  <?php echo label_for('url', 'Archivo local:', 'class="required" ') ?>

  <div class="content">
    <?php $value = input_file_tag('video', array ('size' => 65)); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <span style="color: blue">(Menor 2GB)</span>
    <span id="file_upload_progress" style="color:blue; display:none;">Progreso...</span>
  </div>
</div>

<div class="form-row" id="input_trans_file" style="display: none">

  <?php echo label_for('file', 'Archivo en el Servidor:', 'class="required" ') ?>

  <div class="content">
    <?php $value = input_tag('file', '//172.20...' ,array ('size' => 80)); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <?php echo button_to_function('explorar', "Effect.toggle('explorer_videoserv_file','blind', { afterFinish:function(){ Modalbox.resizeToContent() }})" )?>
    <div id="explorer_videoserv_file" class="videoserv" style="display:none;">
      
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_transcoder_inbox') as $dir):?>
        <li class="collapsed">
          <span onclick="fileServerTree(this, 'file', '<?php echo $dir?>', 0, 'explorer_videoserv_file')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>   


  </div>
</div>




<div class="form-row" id="input_trans_dir" style="display:none">
  <?php echo label_for('url','Directorio en el servidor:', 'class="required" ') ?>
  <div class="content">
    <input type="text" size="80" id="url" name="url" /> 
    <?php echo button_to_function('explorar', "Effect.toggle('explorer_videoserv_dir','blind')" )?>
      <div id="explorer_videoserv_dir" class="videoserv" style="display:none;">
      
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_transcoder_inbox') as $dir):?>
        <li class="collapsed">
          <span onclick="dirServerTree(this, 'url', '<?php echo $dir?>', 0, 'explorer_videoserv_dir')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>    
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save'); ?></li>
</ul>

</form>
</div>
