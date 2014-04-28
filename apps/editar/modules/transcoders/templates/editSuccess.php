<?php use_helper('Object') ?>

<div id="tv_admin_container">

<!-- <form method="post" action="/editar_dev.php/transcoders/upload" enctype="multipart/form-data" name="formulario"> -->

<form method="post" target="iframeUpload" action="<?php echo url_for('transcoders/upload') ?>" enctype="multipart/form-data" name="formulario">
<iframe name="iframeUpload" style="display:none" src=""></iframe> 


<input type="hidden" name="num_video" id="num_video" value="<?php echo $mm->getId() ?>" />
<input type="hidden" name="num_serie" id="num_serie" value="<?php echo $mm->getSerialId() ?>" />
<input type="hidden" name="proveedor" id="proveedor" value="<?php echo sfConfig::get('app_transcoder_proveedor') ?>" />  <!-- ojo  -->
<input type="hidden" name="titulo" id="titulo" value="<?php echo $sf_data->getRaw('mm')->getTitle()?>" />
<input type="hidden" name="tit_serie" id="tit_serie" value="<?php echo $sf_data->getRaw('mm')->getSerialWithI18n()->getTitle()?>" />
<input type="hidden" name="fecha_acto" id="fecha_acto" value="<?php echo $mm->getRecorddate('ymd')?>" />
<input type="hidden" name="copiar" id="copiar" value="1" />



<fieldset>

<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): echo $sep?>
  
      <?php $value = input_tag('description_' . $lang, '', array ('size' => 80,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('profile_id', __('Perfil:'), 'class="required" ') ?>

  <div class="content" style="overflow: hidden">
    <?php foreach($profiles as $profile): ?>
      <span style="display: block; float: left; width: 30%; overflow: hidden">
      <?php echo radiobutton_tag('master', $profile->getId(), 1) ?><?php echo $profile->getName()?>
      </span>
    <?php endforeach?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('priority',__('Prioridad:'), 'class="required" ') ?>

  <div class="content">
    <input type="radio" value="1" name="prioridad"/><?php echo __('Low-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" checked="checked" value="2" name="prioridad"/><?php echo __('Normal-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="3" name="prioridad"/><?php echo __('High-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
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
    <input type="radio" name="file_type" value="file" onclick="$('input_trans_url').hide();$('input_trans_file').show();"/> Inbox 
    <input type="radio" name="file_type" value="url" checked="checked" onclick="$('input_trans_file').hide();$('input_trans_url').show();"/> <?php echo __('File')?>
  </div>
</div>

<div class="form-row" id="input_trans_url">

  <?php echo label_for('url', __('URL:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = input_file_tag('video', array ('size' => 70)); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <span style="color: blue"><?php echo __('(Menor 2GB)')?></span>
    <span id="file_upload_progress" style="color:blue; display:none;"><?php echo __('Progreso...')?></span>
  </div>
</div>

<div class="form-row" id="input_trans_file" style="display: none">

  <?php echo label_for('file', __('File:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = input_tag('file', '//172.20...' ,array ('size' => 80)); echo $value ? $value : '&nbsp;' ?> &nbsp;
    <?php echo button_to_function('explorar', "Effect.toggle('explorer_videoserv','blind', { afterFinish:function(){ Modalbox.resizeToContent() }})" )?>
    <div id="explorer_videoserv" class="videoserv" style="display:none;">
      
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_transcoder_inbox') as $dir):?>
        <li class="collapsed">
          <span onclick="fileServerTree(this, 'file', '<?php echo $dir?>', 0, 'explorer_videoserv')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>   


  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),array('name' => 'OK', 'class' => 'tv_admin_action_save',  'onclick' => "$('file_upload_progress').show(); ")) ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>