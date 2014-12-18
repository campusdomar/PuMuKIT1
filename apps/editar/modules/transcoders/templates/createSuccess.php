<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_transcoders', 
  'url' => 'transcoders/directory',
  'script' => 'true',
)) ?>

<fieldset>

<div class="form-row">
  <?php echo label_for('profile_id','Perfiles:', 'class="required" ') ?>

  <div class="content" style="overflow: hidden">
    <?php foreach($profiles as $profile): if(!$profile->getWizard()) continue;?>
      <span style="display: block; float: left; width: 30%; overflow: hidden">
      <?php echo checkbox_tag('perfil[]', $profile->getId(), 0) ?><?php echo $profile->getName()?>
      </span>
    <?php endforeach?>
  </div>
</div>



<div class="form-row">
  <?php echo label_for('priority','Prioridad:', 'class="required" ') ?>

  <div class="content">
    <input type="radio" value="1" name="prioridad"/>Low-Priority&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" checked="checked" value="2" name="prioridad"/>Normal-Priority&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="3" name="prioridad"/>High-Priority&nbsp;&nbsp;&nbsp;&nbsp;
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
  <?php echo label_for('url','URL:', 'class="required" ') ?>
  <div class="content">
    <input type="text" size="53" id="url" name="url" /> 
    <?php echo button_to_function('explorar', "Effect.toggle('explorer_videoserv','blind')" )?>
    <div id="explorer_videoserv" class="videoserv" style="display:none;">
      
      <ul class="videoserv_tree">
        <?php foreach(sfConfig::get('app_transcoder_path_win') as $dir):?>
        <li class="collapsed">
          <span onclick="dirServerTree(this, 'url', '<?php echo $dir?>', 0, 'explorer_videoserv')"><?php echo $dir?></span>
          <ul></ul>
        </li>
        <?php endforeach;?>
      </ul>

    </div>    
  </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK', array('name' => 'OK',  'class' => 'tv_admin_action_save', 'onclick' => "if($('url').value.trim()=='') { alert('Falta URL');return false; }else{Modalbox.hide();}")); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>