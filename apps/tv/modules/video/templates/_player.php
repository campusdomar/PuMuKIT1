<div class="mm_player">
  <?php include_partial('playerhtml5', array('file' => $file, 'w' => 620, 'h' => 465, 'mmobj' => $mmobj, 'noautostart' => false))?>

  <div class="num_view">
    <?php echo __('Visto')?>: 
    <span class="num_view_number"><?php echo $file->getNumView()?></span>
    <?php echo (($file->getNumView() == 1)?__('vez'):__('veces'))?>
  </div>
  <div class="date">
  <!-- Fixme falta estilo de esto -->
    <?php echo __('Data de celebración')?>: <?php echo $mmobj->getRecordDate('d/m/Y') ?>
  </div>
  <div class="title">
    <?php echo $mmobj->getSubtitle() ?>
  </div>


  <p class="description">
    <?php echo $mmobj->getDescription() ?>
  </p>

  <?php include_partial('bodyMm', array('mm' => $mmobj, 'roles' => $roles)) ?>

</div>
