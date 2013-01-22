<h2><?php echo __('Buscar') ?></h2>

<div id="buscar" align="center">
  <form name="form1" method="post" action="<?php echo url_for('library/index')?>">
    <input type="text" class="text" name="search" id="search" style="width: 88%; margin:4px 0px; font-size: 85%"/>
    <input type="submit" name="Submit" value="Buscar" />
  </form>
</div>
