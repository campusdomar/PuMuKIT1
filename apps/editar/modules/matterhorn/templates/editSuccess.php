<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'files_mms', 
  'url' => 'matterhorn/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($oc, 'getId') ?>
<input type="hidden" name="mm" id="mm" value="<?php echo $oc->getId() ?>" />
<input type="hidden" name="preview" id="preview" value="true" />
<fieldset>




<div class="form-row">
  <?php echo label_for('display', __('Visible:'), 'class="required" ') ?>
  <div class="content">
    <?php $value = object_checkbox_tag($oc, 'getDisplay', array (
      'control_name' => 'display',
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('invert', __('Orden:'), 'class="required" ') ?>
  <div class="content">
    <select name="invert" id="invert">
      <option value="0" <?php echo $oc->getInvert() == 0? 'selected="selected"' : '' ?> ><?php echo __('Normal')?></option>
      <option value="1" <?php echo $oc->getInvert() == 1? 'selected="selected"' : '' ?> ><?php echo __('Invertido')?></option>
    </select>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('language_id', __('Idioma:'), 'class="required" ') ?>

  <div class="content">
    <?php $value = object_select_tag($oc, 'getLanguageId', array (
      'related_class' => 'Language',
      'control_name' => 'language_id',
      'include_blank' => false,
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('duration', __('Duración:'), 'class="required" ') ?>

  <div class="content" id="durationFile">
    <?php include_partial('files/duration', array('min' => $oc->getDurationMin(), 'seg' => $oc->getDurationSeg() )) ?>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
