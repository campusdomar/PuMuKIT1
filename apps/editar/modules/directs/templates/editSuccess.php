<?php use_helper('Object', 'JSRegExp') ?>


<div id="tv_admin_container">
 
<?php echo form_remote_tag(array( 
  'update' => 'list_directs', 
  'url' => 'directs/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($direct, 'getId') ?>

<fieldset>
<div class="form-row">
  <?php echo label_for('name', __('Nombre:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $direct->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($direct, 'getName', array (
        'size' => 68,
        'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('description', __('Descripción:'), 'class="required"') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $direct->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($direct, 'getDescription', array (
        'size' => '68x3',
        'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('broadcasting', __('Estado:'), 'class="required" ') ?>
  <div class="content">
    <select name="broadcasting" id="status" >
      <option <?php echo (($direct->getBroadcasting() == 0)?'selected="selected"':''); ?> value="0"><?php echo __('Espera')?></option>
      <option <?php echo (($direct->getBroadcasting() == 1)?'selected="selected"':''); ?> value="1"><?php echo __('Emitiendo en Directo')?></option>
    </select>
  </div>
</div>

<div class="form-row">
      <?php echo label_for('homeplayer', __('Homeplayer:'), 'class="required" ') ?>
  <div class="content">
      <input type="checkbox" name="homeplayer" value="homeplayer" <?php echo (($direct->getIndexPlay() == 1)?'checked':''); ?> >
  </div>
</div>


<div class="form-row">
  <?php echo label_for('url', __('URL:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($direct, 'getUrl', array (
      'size' => 68,
      'control_name' => 'url',
    )); echo $value ? $value : '&nbsp;' ?>
    <span id="error_url" style="display:none" class="error"><?php echo __('Formato URL no v&aacute;lido')?></span>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('passwd', __('Password:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_input_tag($direct, 'getPasswd', array (
       'size' => 15,
       'control_name' => 'passwd',
    )); echo $value ? $value : '&nbsp;' ?>
    <span><?php echo __('Vac&iacute;o para ser p&uacute;blico')?></span>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('resolution_id', __('Resoluci&oacute;n'), 'class="required"') ?>

  <div class="content">
    <?php $value = object_select_tag($direct, 'getResolutionId', array (
      'related_class' => 'Resolution',
      'control_name' => 'resolution_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('mime_type_id', __('Tecnología:'), 'class="required"') ?>

  <div class="content">
    <?php $value = object_select_tag($direct, 'getDirectTypeId', array (
      'related_class' => 'DirectType',
      'control_name' => 'direct_type_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('source_name', __('STREAM:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($direct, 'getSourceName', array (
      'size' => 20,
      'control_name' => 'source_name',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('ip_source', __('IP fuente:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($direct, 'getIpSource', array (
      'size' => 20,
      'control_name' => 'ip_source',
    )); echo $value ? $value : '&nbsp;' ?>
    <div class="tooltip"> i <div> * <?php echo __('para indicar cualquiera')?></div></div>
  </div>
</div>


<div class="form-row">
    <?php echo label_for('calidades', __('Calidades:'), 'class="required" ') ?>
  <div class="content">
    <?php for ($i = 0; $i < 3; $i++): ?>
      <?php echo ($i+1)."."; ?>
      <input style="margin-top: 5px;" type="text" size="6" value="<?php echo isset($multi[$i])? $multi[$i] : "";  ?>" id="calidad_<?php echo $i ?>" name="calidad['<?php echo $i ?>']" class="MB_focusable"> kbps &nbsp;
      <input style="margin-top: 5px;" type="text" size="6" value="<?php echo isset($multi[$i+3])? $multi[$i+3] : ""; ?>" id="res_<?php echo $i ?>" name="resolutions['<?php echo ($i+3); ?>']" class="MB_focusable"> <?php echo __('píxels')?> &nbsp;&nbsp;
<br />
    <?php endfor;?>
  </div>
</div>


<div class="form-row">
      <?php echo label_for('debug', __('Debug:'), 'class="required" ') ?>
  <div class="content">
      <input type="checkbox" name="debug" value="debug" <?php echo (($direct->getDebug() == 1)?'checked':''); ?> >
  </div>
</div>


</fieldset>

<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_direct($("url").value)'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
