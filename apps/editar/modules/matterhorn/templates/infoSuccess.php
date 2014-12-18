<div style="text-align:center; padding: 5px 0px 10px;">
  <a href="<?php echo $oc_server?>" target="_blank">
    <img src="<?php echo $oc_server . $img ?>" alt="logo org OCMH" />
  </a>
</div>

<ul style="padding-left: 15px">
  <li>Server: <a href="<?php echo $oc_server ?>" target="_blanck"><?php echo $oc_server ?></a></li>
  <li>User: <?php echo $username ?></li>
  <li>Roles: <?php echo $roles ?></li>
</ul>

<div style="padding: 10px 0px">
  <div>
    <input type="checkbox" id="anonymous" name="anonymous" <?php echo $sf_user->getAttribute('anonymous', true, 'tv_admin/matterhorn')?'checked="checked"':'' ?>
         onchange="new Ajax.Updater('anonymous_checkbox', '<?php echo url_for('matterhorn/toggle?value=') ?>/' + (this.checked?'true':'false'))"/> 
    <label for="anonymous" style="display:inline">Acceso an&oacute;nimo</label>
  </div>
  <div id="anonymous_checkbox">&nbsp;</div>
</div>