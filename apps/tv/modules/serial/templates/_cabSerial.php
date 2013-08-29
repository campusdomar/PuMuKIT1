<div class="<?php $aux = $serial->getBroadcastMax();echo ($aux)?$aux->getBroadcastType()->getName():''?>"></div>

<div class="cab_serial">
  <!--<h1 class="title">
    <?php echo $serial->getTitle() ?>
  </h1>-->


  <?php if ($serial->getSubtitle() !== ""): ?> 
    <h2 class="subtitle">
      <?php echo $serial->getSubtitle()?>
    </h2>
  <?php endif; ?>
  
    
  <?php $precinct = $serial->getPrecinct(); if (($precinct)&&($precinct->getId()>1)): ?>
    <h3 class="place">
      <!-- falta address -->
      <?php echo $precinct->getCompleteName()?>
    </h3>
  <?php endif; ?>

</div>