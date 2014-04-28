<?php use_helper('Object') ?>

<h3 class="cab_body_div">
  <img src="/images/admin/cab/process.png"/> <?php echo __('Transcoder Video')?>
</h3>


<div style="margin: 40px; padding: 40px">
<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'transcoder_result', 
  'url' => 'transcoders/one',
  'script' => 'true',
)) ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('profile_id', __('Perfiles:'), 'class="required" ') ?>

  <div class="content" style="overflow: hidden">
    <?php foreach($profiles as $profile): ?>
      <span style="display: block; float: left; width: 30%; overflow: hidden">
      <?php echo checkbox_tag('perfil[]', $profile->getId(), 0) ?><?php echo $profile->getName()?>
      </span>
    <?php endforeach?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('priority', __('Prioridad:'), 'class="required" ') ?>

  <div class="content">
    <input type="radio" value="1" name="prioridad"/><?php echo __('Low-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" checked="checked" value="2" name="prioridad"/><?php echo __('Normal-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="3" name="prioridad"/><?php echo __('High-Priority')?>&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id', __('Idioma:'), 'class="required" ') ?>

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
  <?php echo label_for('url', __('URL_IN:'), 'class="required" ') ?>
  <div class="content">
    <input type="text" size="53" id="url" name="url" /> 
    <?php echo button_to_function('explorar', "Effect.toggle('explorer_videoserv','blind')" )?>
    <div id="explorer_videoserv" class="videoserv" style="display:none;">
      
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_transcoder_path_win') as $dir):?>
        <li class="collapsed">
          <span onclick="fileServerTree(this, 'url', '<?php echo $dir?>', 'explorer_videoserv')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>    
  </div>
</div>



<div class="form-row">
  <?php echo label_for('urlout', __('URL_OUT:'), 'class="required" ') ?>
  <div class="content">
    <input type="text" size="53" id="urlout" name="urlout" value="\\172.20.209.52\video_tmp3\tmp" /> 
  </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'), array('name' => 'OK',  'class' => 'tv_admin_action_save', 'onclick' => "if($('url').value.trim()=='') { alert('<?php echo __('Falta URL')?>');return false; }else{Modalbox.hide();}")); ?></li>
  <li><?php echo reset_tag(__('Cancel'), 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

<div id="transcoder_result" style="font-size: 130%; font-weight: bold;">
</div>

</div>
