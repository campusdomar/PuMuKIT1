<div class="mm_player">

  <div class="date">
  <!-- Fixme falta estilo de esto -->
    <?php echo __('Data de celebración')?>: <?php echo $mmobj->getRecordDate('d/m/Y') ?>
  </div>

  <?php include_partial('player_html5', array('file' => $file, 'mmobj' => $mmobj))?>

  <div class="num_view">
    <?php echo __('Visto')?>: 
    <span class="num_view_number"><?php echo $file->getNumView()?></span>
    <?php echo (($file->getNumView() == 1)?__('vez'):__('veces'))?>
  </div>

  <div class="title">
    <?php echo $mmobj->getSubtitle() ?>
  </div>


  <p class="description">
    <?php echo $mmobj->getDescription() ?>
  </p>

  <?php include_partial('bodyMm', array('mm' => $mmobj, 'roles' => $roles)) ?>

</div>
