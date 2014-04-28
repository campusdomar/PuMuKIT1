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
  <?php echo label_for('profile_id',__('Máster:'), 'class="required" ') ?>
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
  <?php echo label_for('pub_channel_id',__('Canales de Pub.:'), 'class="required" ') ?>

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
  <?php echo label_for('priority',__('Prioridad:'), 'class="required" ') ?>

  <div class="content">
    <input type="radio" value="1" name="prioridad"/> <?php echo __('Low-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" checked="checked" value="2" name="prioridad"/> <?php echo __('Normal-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="3" name="prioridad"/> <?php echo __('High-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id',__('Idioma:'), 'class="required" ') ?>

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
  <?php echo label_for('file_type', __('Modo:'), 'class="required" ') ?>
  
  <div class="content">
    <input type="radio" name="file_type" value="file" checked="checked" onclick="$('input_trans_file').hide();$('input_trans_dir').hide();$('input_trans_url').show();"/> <?php echo __('Archivo Local')?>  
    <input type="radio" name="file_type" value="url" onclick="$('input_trans_url').hide();$('input_trans_dir').hide();$('input_trans_file').show();"/> <?php echo __('Archivo de Servidor')?>
    <input type="radio" name="file_type" value="dir" onclick="$('input_trans_url').hide();$('input_trans_file').hide();$('input_trans_dir').show();"/> <?php echo __('Directorio entero del servidor')?>
  </div>
</div>

<div class="form-row" id="input_trans_url">

  <?php echo label_for('url', __('Archivo local:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = input_file_tag('video', array ('size' => 65)); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <span style="color: blue"><?php echo __('(Menor 2GB)')?></span>
    <span id="file_upload_progress" style="color:blue; display:none;"><?php echo __('Progreso...')?></span>
  </div>
</div>

<div class="form-row" id="input_trans_file" style="display: none">

  <?php echo label_for('file', __('Archivo en el Servidor:'), 'class="required" ') ?>

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
  <?php echo label_for('url', __('Directorio en el servidor:'), 'class="required" ') ?>
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
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save'); ?></li>
</ul>

</form>
</div>
