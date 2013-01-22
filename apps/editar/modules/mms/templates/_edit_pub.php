<?php use_helper('Object') ?>

<div id="tv_admin_container" style="padding: 4px 20px 20px">

<?php echo form_remote_tag(array( 
  'update' => 'list_mms', 
  'url' => 'mms/update_pub',
  'script' => 'true',
  'failure' => visual_effect('opacity', 'mm_save_error_pub', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0')),
  'success' => visual_effect('opacity', 'mm_save_ok_pub', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0'))
)) ?>


<?php echo object_input_hidden_tag($mm, 'getId') ?>
<?php echo object_input_hidden_tag($mm, 'getSerialId') ?>

<div id="remember_save_mm_pub" style="display: none; position: absolute; color:red; border: 1px solid red; padding: 5px; background-color:#fdc; font-weight:bold;">
  <?php echo __('Pulse OK para que el cambio de publicacion tenga efecto')?>
</div>

<ul class="tv_admin_actions" style="width: 100%">
  <span id="mm_save_error_pub" style="color:red; opacity:0.0; filter: alpha(opacity=0); ZOOM:1">Guardado ERROR</span>
  <span id="mm_save_ok_pub" style="color:blue; opacity:0.0; filter: alpha(opacity=0); ZOOM:1">Guardado OK</span>
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save  onclick=$(\'remember_save_mm_pub\').hide();'); ?></li>
  <li><?php echo reset_tag('Reset','name=reset class=tv_admin_action_delete onclick=$(\'remember_save_mm_pub\').hide()'); ?></li>
</ul> 


<fieldset id="tv_fieldset_none" class="">


<div class="form-row">
  <?php echo label_for('status', 'Estado:', 'class="required long" ') ?>
  <div class="content content_long">
    <div style="float:right"> </div>


<!-- SELECT -->
<select name="status" id="filters_anounce" onchange="$('remember_save_mm_pub').show()" <?php echo ($sf_user->getAttribute('user_type_id', 1) == 0)?'':'disabled="disabled"' ?> >
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_NORMAL)?'selected="selected"':''); ?>value="0" >Publicado</option>
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_BLOQ)?'selected="selected"':''); ?>value="1" >Bloqueado</option>
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_HIDE)?'selected="selected"':''); ?>value="2" >Oculto</option>
</select>
<!-- END SELECT -->


  </div>
  <div id="pub_mm_info" style="width: 99%; padding:10px;"></div>
</div>
<!-- else avisar para publicar-->


<!-- Si no tiene master podia no poder cambiar pub_channels -->
<div class="form-row" id="list_pub_channel" <?php echo ($mm->getStatusId() == 1)?'style="background-color: #f2f2f2':''?>">
  <?php echo label_for('pub', 'Canales de Publicacion:', 'class="required long" ') ?>
  <div id="list_pub_<?php echo $mm->getId()?>" class="content content_long">
    <?php include_partial('list_pub', array('mm' => $mm)) ?>
  </div>
</div>




<div class="form-row">
  <?php echo label_for('announce', 'Decisiones Editoriales:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $value = object_checkbox_tag($mm, 'getAnnounce', array (
      'control_name' => 'announce',
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>&nbsp; Novedad
  </div>


 <div class="content content_long">
    <?php $value = object_checkbox_tag($mm, 'getEditorial1', array (
      'control_name' => 'editorial1',
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>&nbsp; Decisi&oacute;n Editorial 1
  </div>

  <div class="content content_long">
    <?php $value = object_checkbox_tag($mm, 'getEditorial2', array (
      'control_name' => 'editorial2',
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>&nbsp; Decisi&oacute;n Editorial 2
  </div>

  <div class="content content_long">
    <?php $value = object_checkbox_tag($mm, 'getEditorial3', array (
      'control_name' => 'editorial3',
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>&nbsp; Decisi&oacute;n Editorial 3
  </div>

</div>


<div class="form-row">
  <?php echo label_for('broadcast_id', 'Perfil de distribución:', 'class="required long"') ?>
  <div class="content content_long">
    <?php $value = object_select_tag($mm, 'getBroadcastId', array (
      'related_class' => 'Broadcast',
      'control_name' => 'broadcast_id',
      'include_blank' => false,
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>



<!--
<div class="form-row">
  <?php echo label_for('itunesu', 'iTunes U:', 'class="required long" ') ?> 
  <div class="content content_long">
    <?php if(count($mm->getSerial()->getSerialItuness()) == 0):?>
      <a href="#" onclick="
  new Ajax.Updater('itunes_mm_info', '<?php echo url_for('mms/ituneson?id=' . $mm->getId())?>', {asynchronous:true, evalScripts:true}); return false;
">Publicar en itunes U.</a>
    <?php else:?>
      <a href="#" onclick="
  new Ajax.Updater('itunes_mm_info', '<?php echo url_for('mms/ituneson?id=' . $mm->getId())?>', {asynchronous:true, evalScripts:true}); return false;
">Quitar de itunes U.</a>
    <?php endif?>

  </div>
  <div id="itunes_mm_info" style="width: 99%; padding:10px;">
    <?php include_partial('mms/itunes_list', array('itunes' => $mm->getSerial()->getSerialItuness()))?>
  </div>
</div>
-->


</fieldset>

</form>
</div>
