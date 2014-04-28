<!-- Vista previa -->
<?php if( isset($place) ):?>
  <div>
    <?php echo $place->getName()?>  
  </div>

<?php else:?>
  <p>
    <?php echo __('Seleccione primero un lugar y después un recinto')?>.
  </p>
<?php endif?>  
