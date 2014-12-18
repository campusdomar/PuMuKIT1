<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'links_mms', 
  'url' => 'links/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($link, 'getId') ?>
<input type="hidden" name="mm" id="mm" value="<?php echo $link->getMmId() ?>" />
<input type="hidden" name="preview" id="preview" value="true" />

<fieldset>

<div class="form-row">
  <?php echo label_for('name', 'Nombre:', 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $link->setCulture($lang);  echo $sep ?>  
  
        <?php $value = object_input_tag($link, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
        )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('url', 'Url:', 'class="required" ') ?>

  <div class="content">
    <?php $value = object_input_tag($link, 'getUrl', array (
      'size' => 66,
      'control_name' => 'url'
    )); echo $value ? $value : '&nbsp;' ?>
    <span id="error_url" style="display:none" class="error">Formato URL no v&aacute;lido. Ejemplo: http://pumukit.org</span>
  </div>
</div>



</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=return comprobar_form_url($("url").value)') ?>   </li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>
