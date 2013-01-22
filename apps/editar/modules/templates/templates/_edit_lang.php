<?php use_helper('Object') ?>

<div class="entry-edit">
  <h4 class="icon-head head-edit-form fieldset-legend"><?php echo $template->getName()?></h4>
</div>

<br />
<p>
  <?php echo $template->getDescription()?>
  (<?php echo $template->getTypeName()?><?php echo ($template->getUser()?' USER':'')?>)
</p>

<br />

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'url' => 'templates/update',
  'loading' => "Element.show('loading_".$template->getId()."')",
  'complete' => "['loading_".$template->getId()."', 'save_".$template->getId()."'].each(Element.hide);",
)) ?>

<?php echo object_input_hidden_tag($template, 'getId') ?>


<fieldset>

<div class="form-row">
  <?php $sep =''; foreach (sfConfig::get('app_lang_array') as $lang): ?>
    <?php $template->setCulture($lang);  echo $sep ?>  

    <?php echo label_for('text_'. $lang, 'Text (' . $lang . '):', '') ?>
    <div class="content">

   
      <?php $value = object_textarea_tag($template, 'getText', array (
        'size' => '100x14',
        'control_name' => 'text_' . $lang,
        'onchange' => "Element.show('save_".$template->getId()."')",
      )); echo $value ? $value : '&nbsp;' ?>
    </div>

    <?php $sep='<br />'?>
  <?php endforeach; ?>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><img id="loading_<?php echo $template->getId()?>" src="/images/admin/load/spinner.gif" alt="Loading..." height="15" style="display:none; position:absolute"/></li>
  <li><input type="submit" class="tv_admin_action_save" value="OK" name="OK"/></li>
  <li><input type="reset"  class="tv_admin_action_delete" value="Cancel" name="Cancel"/></li>
</ul>

</form>
</div>






