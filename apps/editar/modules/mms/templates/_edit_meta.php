<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container" style="padding: 4px 20px 20px">

<?php echo form_remote_tag(array( 
  'update' => 'list_mms', 
  'url' => 'mms/update',
  'script' => 'true',
  'failure' => visual_effect('opacity', 'mm_save_error', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0')),
  'success' => visual_effect('opacity', 'mm_save_ok', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0'))
               .remote_function(array('update' => 'preview_mm', 'url' => 'mms/preview?id=' . $mm->getId(), 'script' => 'true' )),

)) ?>


<?php echo object_input_hidden_tag($mm, 'getId') ?>
<?php echo object_input_hidden_tag($mm, 'getSerialId') ?>

<div id="remember_save_mm" style="display: none; position: absolute; color:red; border: 1px solid red; padding: 5px; background-color:#fdc; font-weight:bold;">
  <?php echo __('Pulse OK para que el cambio tenga efecto')?>
</div>

<ul class="tv_admin_actions" style="width: 100%">
  <span id="mm_save_error" style="color:red; opacity:0.0; filter: alpha(opacity=0); ZOOM:1"><?php echo __('Guardado ERROR')?></span>
  <span id="mm_save_ok" style="color:blue; opacity:0.0; filter: alpha(opacity=0); ZOOM:1"><?php echo __('Guardado OK')?></span>
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save  onclick=if(comprobar_form_mm($("publicdate").value, $("recorddate").value, '. get_js_regexp_timedate($sf_user->getCulture()) . ')){$(\'remember_save_mm\').hide();}else{return false}'); ?></li>
  <li><?php echo reset_tag('Reset','name=reset class=tv_admin_action_delete onclick=$(\'remember_save_mm\').hide()'); ?></li>
</ul> 

<fieldset id="tv_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('title', __('T&iacute;tulo:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getTitle', array (
        'size' => 80,
        'control_name' => 'title_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('subtitle', __('Subt&iacute;tulo:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getSubtitle', array (
        'size' => 80,
        'control_name' => 'subtitle_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('keyword', __('Keyword:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getKeyword', array (
        'size' => 80,
        'control_name' => 'keyword_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('copyright',__('Copyright:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $value = object_input_tag($mm, 'getCopyright', array (
      'size' => 30,
      'control_name' => 'copyright',
      'onchange' => "$('remember_save_mm').show()",
     )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('genre_id', __('Género:'), 'class="required long"') ?>
  <div class="content content_long">
    <?php $value = object_select_tag($mm, 'getGenreId', array (
      'related_class' => 'Genre',
      'control_name' => 'genre_id',
      'peer_method' => 'doSelectByAbcWithI18n2',
      'include_blank' => false,
      'onchange' => "$('remember_save_mm').show()",
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('publicdate', __('Fecha de publicaci&oacute;n:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $value = object_input_date_tag($mm, 'getPublicdate', array (
      'rich' => true,
      'withtime' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'publicdate',
      'onchange' => "$('remember_save_mm').show()",
    )); echo $value ? $value : '&nbsp;' ?>
    <span id="error_date1" style="display:none" class="error"><?php echo __('Formato fecha no v&aacute;lido')?></span> 
  </div>
</div>


<div class="form-row">
  <?php echo label_for('recorddate', __('Fecha de grabaci&oacute;n:'), 'class="required long" ') ?>
  <div class="content content_long">
    <?php $value = object_input_date_tag($mm, 'getRecorddate', array (
      'rich' => true,
      'withtime' => true,
      'calendar_button_img' => '/images/admin/buttons/date.png',
      'control_name' => 'recorddate',
      'onchange' => "$('remember_save_mm').show()",
    )); echo $value ? $value : '&nbsp;' ?>
    <span id="error_date2" style="display:none" class="error"><?php echo __('Formato fecha no v&aacute;lido')?></span> 
  </div>
</div>


<div class="form-row">
  <?php echo label_for('description', __('Descripci&oacute;n:'), 'class="required long"') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($mm, 'getDescription', array (
        'size' => '80x3',
        'control_name' => 'description_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('subserial', __('Subserie:'), 'class="long"') ?>
  <div class="content content_long">
    <?php $value = object_checkbox_tag($mm, 'getSubserial', array (
      'control_name' => 'subserial',
      'onchange' => "$('remember_save_mm').show()",
    )); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('line2', __('Titular:'), 'class="long"') ?>
    <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getLine2', array (
        'size' => 80,
        'control_name' => 'line2_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('subserial_title', __('T&iacute;tulo de subserie:'), 'class="long"') ?>
    <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getSubserialTitle', array (
        'size' => 80,
        'control_name' => 'subserial_title_' . $lang,
        'onchange' => "$('remember_save_mm').show()",
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

</fieldset>

</form>
</div>








