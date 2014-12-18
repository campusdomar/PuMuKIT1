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

  new parent.Ajax.Updater('".$upload."', '".url_for($sf_data->getRaw('url'), true)."', {asynchronous: true, evalScripts: true});
  parent.$('".$upload."').innerHTML= 'Actualize el video para que se muestren las imagenes.';

  parent.$('div_messages_span_info').innerHTML ='Nueva imagen subida e insertada.';
  new parent.Effect.Opacity('div_messages_info', {duration:7.0, from:1.0, to:0.0});
"); ?>
