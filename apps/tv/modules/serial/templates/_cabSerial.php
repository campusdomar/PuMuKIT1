<div class="<?php echo $serial->getBroadcastMax()->getBroadcastType()->getName()?>"></div>

<?php if($serial->hasSubtitles()): ?>
  <img style="float:right" src="/images/tv/iconos/simbolo_manos_40.png" alter="signado" />
<?php endif ?>

<div class="cab_serial">
<!--  <h1 class="title">
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