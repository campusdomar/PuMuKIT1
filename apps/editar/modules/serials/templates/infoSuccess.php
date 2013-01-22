<div id="tv_admin_container">
<form>
<fieldset>


<h2><strong>URL:</strong></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Serie:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $serial->getUrl(true) ?>" />
  </div>
  <br />
  <?php echo label_for('embed', 'M&aacute;gica', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $hash->getUrl(true) ?>" />   
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('OK', "Modalbox.hide()", 'class=tv_admin_action_save') ?> </li>
</ul>

</form>
</div>


