<div id="tv_admin_container">
<form>
<fieldset>

<h2><?php echo "<strong>URLs para imagenes:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Presenter:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $camera ?>" />
  </div>
  <br />
  <?php echo label_for('embed', 'Presentation:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $screen ?>" />   
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('OK', "Modalbox.hide()", 'class=tv_admin_action_save') ?> </li>
</ul>

</form>
</div>


