<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_notices', 
  'url' => 'notices/update',
  'script' => 'true',  
)) ?>

<?php echo object_input_hidden_tag($notice, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('date', __('Fecha:'), 'class="required" ') ?>
  <div class="content">
    <?php echo object_input_date_tag($notice, 'getDate', array (
      'rich' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'date',
    )) ?>
    <span id="error_date" style="display:none" class="error"><?php echo __('Formato fecha no v&aacute;lido')?></span>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('working', __('Oculto:'), 'class="required" ') ?>
  <div class="content">
    <?php echo object_checkbox_tag($notice, 'getWorking', array (
  	// 'onchange' => 'submit()',
    )) ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('text', __('Texto:'), 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $notice->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($notice, 'getText', array (
        'size' => '80x7',
        'control_name' => 'text_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=return comprobar_form_notice($("date").value, '. get_js_regexp_date($sf_user->getCulture()) . ')'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

