<div style="overflow: hidden; padding: 10px; ">
  <div class="" style="width: 50%; float: left">
    <h2><?php echo __('Más vistos')?></h2>
    <div class="view-content">
      <?php include_partial('global/mmobj', array('mmobjs' => $popular))?>
    </div>
  </div>
  
  
  <div class="" style="width: 50%; float: left">
    <h2><?php echo __('Últimos añadidos')?></h2>
    <div class="view-content">
      <?php include_partial('global/mmobj', array('mmobjs' => $last))?>
    </div>
  </div>
</div>