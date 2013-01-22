<h2><?php echo __('Buscar') ?></h2>

<div id="buscar" align="center">
  <form name="form1" method="get" action="http://www.google.es/search">
    <input type="hidden" value="es" name="hl"/>
    <input type="hidden" value="<?php echo $domain?>" name="sitesearch"/>
    <input type="text" class="text" name="q" id="qgoogle" style="width: 88%; margin:4px 0px; font-size: 85%"/>
    <input type="submit" name="Submit" value="Buscar" />
  </form>
</div>
