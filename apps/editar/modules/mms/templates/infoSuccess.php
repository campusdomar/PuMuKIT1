<div id="tv_admin_container">
<form>
<fieldset>
<h2><?php echo "<strong>HTML:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Incrustaci&oacute;n IFRAME:', 'class="required" ') ?>
  <div class="content">
    <textarea id="embed_code" name="embed_code" readonly="readonly" cols="80" rows="5" onclick="this.select()"><iframe src="<?php echo $sf_request->getUriPrefix() ?>/video/iframe/id/<?php echo $mm->getId() ?>" style="border:0px #FFFFFF none;" scrolling="no" frameborder="1" height="270" width="480" allowfullscreen webkitallowfullscreen></iframe></textarea>
  </div>
</div>

<h2><?php echo "<strong>URL:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Player:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $mm->getUrl(true) ?>" />
  </div>
  <br />
  <?php echo label_for('embed', 'Serie:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $mm->getSerial()->getUrl(true) ?>" />   
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('OK', "Modalbox.hide()", 'class=tv_admin_action_save') ?> </li>
</ul>

</form>
</div>


