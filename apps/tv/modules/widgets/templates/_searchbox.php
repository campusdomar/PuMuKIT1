<div style="float: right">
  <div class="busca" style="top: 1px;">
     <form name="searchhead" method="get" action="<?php echo url_for('buscador/index')?>">
         <div>
            <label accesskey="t" for="busca" class="salto"><?php echo __("Busca")?>:</label>
            <input class="box_lupa" style="height:16px; width: 120px; padding-right: 20px;" placeholder="<?php echo __("Busca")?>..." name="search" maxlength="100" type="text" />
            <input type="image" src="/images/1.8/lupa_buscador.png" style="position: relative; top: 2px; right: 21px;" name="startsearch" />
         </div>
      </form>
  </div>
</div>