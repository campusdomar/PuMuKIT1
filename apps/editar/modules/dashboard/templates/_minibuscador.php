<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold">BUSCADOR DE SERIES</legend>

<form method="get" action="#" onsubmit="new Ajax.Updater('mini_buscador_result', '<?php echo url_for('dashboard/buscar')?>', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this)}); return false;">
  <input type="text" id="text" name="text" value="titulo, persona, fecha..."/>
  <input type="checkbox" id="all" name="all" checked="checked" title="buscar en todo el contenido"/>
  <input type="submit" value="BUSCAR" />
</form>

<div id="mini_buscador_result" style="border: 1px solid #AAA; min-height: 80px; padding: 5px; overflow: auto;">

 BUSCAR
 
</div>

</fieldset>