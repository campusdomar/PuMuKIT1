<div>
<h1><?php echo $vcat->getName() ?></h1>
</div>


<div style="overflow: hidden">
  <?php foreach($serials as $a_id => $a): ?>
    <div style="width:49%; padding: 2px; float: left">
    <!--- PARTIAL --->
      <?php include_partial('categories/block', array('announce' => $a))?>
    <!--- END PARTIAL --->
    </div>

    <?php if(($a_id%2) != 0):?>
      <div style="width:100%; float:left">&nbsp;</div>
    <?php endif ?>

  <?php endforeach ?> 
</div>



<?php if(0 == count($serials)): ?>
  <?php echo __('No existen vídeos en esta categoría'); ?>
<?php endif ?>
