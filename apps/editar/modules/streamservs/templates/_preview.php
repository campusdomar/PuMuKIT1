<!-- Vista previa -->
<?php if( isset($streamserv) ):?>
<div>
  <p style="text-align:center; font-size: large;">
     <?php echo $streamserv->getName()?>(<?php echo $streamserv->getIp()?>)
  </p>

  <p style="overflow:hidden; padding:5px; text-align:center; border:solid 1px #DDD; background:#DDD; " >
    <?php echo __('Descripción')?>: 
      <?php echo $streamserv->getDescription()?>
  </p>
</div>

  <?php else:?>
<p>
  <?php echo __('Seleccione o cree algún servidor de streaming')?>.
</p>
<?php endif?>


