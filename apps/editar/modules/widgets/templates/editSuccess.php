<div id="tv_admin_container">
 
<?php echo form_remote_tag(array( 
  'update' => 'body_div', 
  'url' => 'widgets/update',
  'script' => 'true',
)) ?>

<fieldset>


<?php foreach($constants as $c):?>
  <div class="form-row">
    <?php echo label_for('constant['.$c->getId().']', $c->getName().':', 'class="required" ') ?>
    <div class="content">
      <?php $value = input_tag('constant['.$c->getId().']', $c->getText() , 'size=80'); echo $value ? $value : '&nbsp;' ?>
    </div>
  </div>
<?php endforeach;?>

<?php foreach($templates as $t):?>
  <div class="form-row">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $t->setCulture($lang);  echo $sep ?>  
    
      <?php echo label_for('template['.$t->getId() .']['. $lang.']', $t->getName().':', 'class="required" ') ?>
      <div class="content">
        <?php $value = textarea_tag('template['.$t->getId() .']['. $lang.']', $t->getText(), 'size=80x5'); 
              echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
      </div>
    
      <?php $sep='<br />'?>
    <?php endforeach; ?>
  </div>
<?php endforeach; ?>



</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag(__('OK'),'name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>
