<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_serialtypes', 
  'url' => 'serialtypes/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($serialtype, 'getId') ?>


<fieldset>
  
  <div class="form-row">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $serialtype->setCulture($lang);  echo $sep ?>  
    
      <?php echo label_for('name_' . $lang, 'Nombre:', 'class="required" ') ?>
      <div class="content">
        <?php $value = object_input_tag($serialtype, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
        )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      </div>
    
      <?php $sep='<br />'?>
    <?php endforeach; ?>
  </div>
  
</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>

