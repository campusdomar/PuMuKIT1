<!-- Vista previa -->
<?php if( isset($precinct) ):?>
<div>
  <p style="text-align:center; font-size: large;">
    <?php echo $precinct->getCompleteName()?>
  </p>

  <p style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:#DDD" >
    COMMENTS: 
      <?php echo $precinct->getComment()?>
    <br />
    EQUIPMENT: 
      <?php echo $precinct->getEquipment()?>
    <br />
    SERIALS: 
      <?php 
        $ss = $precinct->getSerials(3); 
        foreach($ss as $s) echo $s->getId().' ('.$s->getTitle().'),'; 
        if (count($ss) == 5) echo '<strong>...</strong>'
      ?>
    <?php if($precinct->getPlace()->getCoorgeo() != ''):?>
    <br />
    COOR:
        <a href="http://maps.google.es/maps?q=<?php echo $precinct->getPlace()->getCoorgeo() ?>" target="_blank" >Coordenadas en Google Maps</a>
    <?php endif; ?>
  </p>

</div>
<?php else:?>
<p>
  Selecione primero un lugar, y despues un recicnto.
</p>
<?php endif?>  