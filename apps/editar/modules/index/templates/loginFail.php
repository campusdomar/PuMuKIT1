<?php echo javascript_tag("
  $('noUser').show();
  new Effect.Shake(document.getElementById('div_login'));
  $('passwd').value='';
") ?>
