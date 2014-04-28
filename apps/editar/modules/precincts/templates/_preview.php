<!-- Vista previa -->
<?php if( isset($precinct) ):?>
<div>
  <p style="text-align:center; font-size: large;">
    <?php echo $precinct->getCompleteName()?>
  </p>

  <p style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:#DDD" >
    <?php echo __('COMMENTS:')?> 
      <?php echo $precinct->getComment()?>
    <br />
    <?php echo __('EQUIPMENT:')?> 
      <?php echo $precinct->getEquipment()?>
    <br />
    <?php echo __('SERIALS:')?> 
      <?php 
        $ss = $precinct->getSerials(3); 
        foreach($ss as $s) echo $s->getId().' ('.$s->getTitle().'),'; 
        if (count($ss) == 5) echo '<strong>...</strong>'
      ?>
    <?php if($precinct->getPlace()->getCoorgeo() != ''):?>
    <br />
    COOR:
        <a href="http://maps.google.es/maps?q=<?php echo $precinct->getPlace()->getCoorgeo() ?>" target="_blank" ><?php echo __('Coordenadas en Google Maps')?></a>
    <?php endif; ?>
  </p>

</div>
<?php else:?>
<p>
  <?php echo __('Seleccione primero un lugar y después un recinto.')?>
</p>
<?php endif?>