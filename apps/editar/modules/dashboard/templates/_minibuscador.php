<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold"><?php echo __('BUSCADOR DE SERIES')?></legend>

<form method="get" action="#" onsubmit="new Ajax.Updater('mini_buscador_result', '<?php echo url_for('dashboard/buscar')?>', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this)}); return false;">
  <input type="text" id="text" name="text" value="" placeholder=<?php echo __('titulo')?> />
  <input type="checkbox" id="all" name="all" checked="checked" title=<?php echo __('buscar en todo el contenido')?>/>
  <input type="submit" value=<?php echo __('"BUSCAR')?> />
</form>

<div id="mini_buscador_result" style="border: 1px solid #AAA; min-height: 80px; padding: 5px; overflow: auto;">

<?php echo __('BUSCAR')?>
 
</div>

</fieldset>