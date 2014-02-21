<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold"><?php echo __('USO DE DISCO')?></legend>

<?php foreach($disks as $d): $porc = sprintf('%.2f', 100 - ($d[2]*100)/$d[1]) ?>
  <div>
    <span style="font-weight: bold"><?php echo $d[0] ?></span> 
    (<?php echo $d[2] ?>/<?php echo $d[1] ?>)

    <div style="background-color: red; ">
      <div style="background-color: green; float: left; text-align: right; width: <?php echo $porc ?>%"> <?php echo $porc?>%
      </div>
      <div style="clear: left"></div>
    </div>

  </div>
<?php endforeach ?>

</fieldset>