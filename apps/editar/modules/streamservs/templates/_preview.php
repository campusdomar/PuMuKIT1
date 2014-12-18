<!-- Vista previa -->
<?php if( isset($streamserv) ):?>
<div>
  <p style="text-align:center; font-size: large;">
     <?php echo $streamserv->getName()?>(<?php echo $streamserv->getIp()?>)
  </p>

  <p style="overflow:hidden; padding:5px; text-align:center; border:solid 1px #DDD; background:#DDD; " >
    Descripción: 
      <?php echo $streamserv->getDescription()?>
  </p>
</div>

  <?php else:?>
<p>
  Selecione o cree algun servidor de streaming.
</p>
<?php endif?>


