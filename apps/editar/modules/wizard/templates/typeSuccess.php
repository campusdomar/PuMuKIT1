<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => '', 
  'url' => '',
  'script' => 'true',
)) ?>

<fieldset>



<div class="form-row">
  <?php echo label_for('type' , __('Tipo:'), 'class="required long" ') ?>
  <div class="content content_long">
     <ul>
       <li><?php echo __('Opción UNO')?></li>
       <li><?php echo __('Opción DOS')?></li>
     </ul>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
