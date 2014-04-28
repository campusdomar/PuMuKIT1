<!-- Vista previa -->
<?php if( isset($cpu) ):?>
<div>
   <p style="text-align:center; font-size: large;">
    <?php echo $cpu->getIp()?>
  </p>

  <p style="overflow:hidden; padding:5px; text-align:center; border:solid 1px #DDD; background:#DDD; " >
<?php echo __('Descripción:')?> 
      <?php echo $cpu->getDescription()?>
    <br />
    Mínimo: 
      <?php echo $cpu->getMin()?>
    &nbsp;| <?php echo __('Máximo:')?>
      <?php echo $cpu->getMax()?>
    &nbsp;| <?php echo __('Procesos simult&aacute;neos:')?>
      <?php echo $cpu->getNumber()?>
    <br />
    <?php echo __('Estado conexión:')?>
      <?php echo $cpu->isActive() ? "<?php echo __('OK')?>" : "<?php echo __('KO')?>" ?>
  </p>
</div>

  <?php else:?>
<p>
  <?php echo __('Seleccione o cree alguna CPU.')?>
</p>
<?php endif?>


