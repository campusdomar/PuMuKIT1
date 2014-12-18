<!-- Vista previa -->
<?php if( isset($person) ):?>
<div>
   <p style="text-align:center; font-size: large;">
    <?php echo $person->getHName()?>
  </p>

  <p style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:#DDD" >
    INFO: 
      <?php echo $person->getOther()?>
      <br />
    SERIES: 
      <?php 
        $ss = $person->getSerials(5); 
        foreach($ss as $s) echo $s->getId().' ('.$s->getTitle().'),'; 
        if (count($ss) == 5) echo '<strong>...</strong>'
      ?>
  </p>
</div>

  <?php else:?>
<p>
  Selecione alguna persona.
</p>
<?php endif?>


