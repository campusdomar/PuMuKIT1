<?php
/*****************************
 *
 *
 *    No funciona un parent.Ajx.update porque no tiene la coockie de id de session
 *    En FIREFOX y todo  LOCALHOST a veces falla
 *
 *
 ****************************/

?>


<?php echo javascript_tag("
  parent.Modalbox.hide();

  new parent.Ajax.Updater('materials_mms', '".url_for('materials/list?mm='.$mm, true)."', {asynchronous: true, evalScripts: true});
  //new parent.Ajax.Updater('preview_mm', '".url_for('mms/preview?id='.$mm, true)."', {asynchronous: true, evalScripts: true});
  window.update_preview(" . $mm . ");
  parent.$('materials_mms').innerHTML= '". __('Actualice el vídeo para que se muestren las materiales.') . "';

  parent.$('div_messages_span_info').innerHTML ='" . $msg_info . "';
  new parent.Effect.Opacity('div_messages_info', {duration:7.0, from:1.0, to:0.0});
"); ?>

