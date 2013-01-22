<?php use_helper('Object') ?>

<div id="tv_admin_container">

<form id="mm_form_wizard">

<input type="hidden" name="serial_id" value="<?php echo $serial->getId()?>" />
<?php foreach ($langs as $lang): $serial->setCulture($lang)?>
  <input type="hidden" name="serial_title_<?php echo $lang?>" value="<?php echo $serial->getTitle()?>" />
  <input type="hidden" name="serial_subtitle_<?php echo $lang?>" value="<?php echo $serial->getSubtitle()?>" />
<?php endforeach ?>


<fieldset>

<div class="form-row">
  <?php echo label_for('title' , 'T&iacute;tulo:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getTitle', array (
        'size' => 80,
        'control_name' => 'title_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('subtitle', 'Subt&iacute;tulo:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getSubtitle', array (
        'size' => 80,
        'control_name' => 'subtitle_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('description', 'Descripci&oacute;n:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_textarea_tag($mm, 'getDescription', array (
        'size' => '80x2',
        'control_name' => 'description_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('subserial_title', 'T&iacute;tulo de Subserie:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $mm->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($mm, 'getSubserialTitle', array (
        'size' => 80,
        'control_name' => 'subserialtitle_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>


      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  <li><?php echo button_to_function('Next', "Modalbox.show('".url_for("wizard/file")."',{title:'PASO III: FILES.', params:Form.serialize('mm_form_wizard')})", 'class=tv_admin_action_next') ?> </li>
</ul>

</form>
</div>
