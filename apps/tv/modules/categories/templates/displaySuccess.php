<div>
<h1><?php echo $vcat->getName() ?></h1>
</div>

<div style="margin: 5px 0px 15px">
  <?php foreach ($serials_by_year as $year => $y_serials):?>
    <h2 class="nada">
      <span><?php echo $year;?></span>
    </h2>

    <div style="overflow: hidden">
      <?php foreach($y_serials as $a_id => $a): ?>
        <div style="width:49%; padding: 2px; float: left">
          <?php include_partial('categories/block', array('announce' => $a))?>
        </div>
        <?php if(($a_id%2) != 0): //vertical separation between each pair of serial blocks?>
          <div style="width:100%; float:left">&nbsp;</div>
        <?php endif ?>
      <?php endforeach ?> 
    </div>
  <?php endforeach ?>
</div>

<?php if(0 == count($serials_by_year)): ?>
  <?php echo __('No existen vídeos en esta categoría'); ?>
<?php endif ?>