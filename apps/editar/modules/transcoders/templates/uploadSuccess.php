<?php echo javascript_tag("
  parent.Modalbox.hide();

  new parent.Ajax.Updater('files_mms', '".url_for('files/list?mm='.$mm, true)."', {asynchronous: true, evalScripts: true});
  new parent.Ajax.Updater('preview_mm', '".url_for('mms/preview?id='.$mm, true)."', {asynchronous: true, evalScripts: true});
  parent.$('files_mms').innerHTML= '" . __('Actualice el vídeo para que se muestren los archivos.') . "';
"); ?>
