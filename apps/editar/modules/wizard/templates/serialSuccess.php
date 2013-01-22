<?php use_helper('Object') ?>

<div id="tv_admin_container">

<form id="serial_form_wizard">
<?php echo object_input_hidden_tag($serial, 'getId') ?>

<fieldset>



<div class="form-row">
  <?php echo label_for('title' , 'T&iacute;tulo:', 'class="required long" ') ?>
  <div class="content content_long">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $serial->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($serial, 'getTitle', array (
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
      <?php $serial->setCulture($lang);  echo $sep ?>  

      <?php $value = object_input_tag($serial, 'getSubtitle', array (
        'size' => 80,
        'control_name' => 'subtitle_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>

      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li> 
  <li><?php echo button_to_function('Next', "Modalbox.show('".url_for("wizard/mm")."',{title:'PASO II: OBJ.MM.', params:Form.serialize('serial_form_wizard')})", 'class=tv_admin_action_next') ?> </li>
</ul>

</form>
</div>
