<!-- Vista previa -->
<?php if( isset($event) ):?>
<div>
  <p style="text-align:center; font-weight: bolder; font-size: large;">
    <?php echo $sf_data->getRaw('event')->getName()?>
  </p>
  <p style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:<?php echo ($event->getDisplay() ? '#FFEAD6' : '#DDD') ?>" >
    <?php echo $event->getDate('d/m/Y H:m')?>  <?php echo $event->getDuration()?> <?php echo __('min.')?>
  </p>
</div>

<?php else:?>
<p>
  <?php echo __('Seleccione o cree algún evento en directo.')?>
</p>
<?php endif?>  
