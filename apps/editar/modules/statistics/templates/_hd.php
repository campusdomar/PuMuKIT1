<div style="background-color: red; padding: 5px; "> <?php echo __('Uso de CPUs')?> </div>

<ul>
<?php foreach($hds as $h): ?>
<li> 
<span > <?php echo intval(100 * $h["%"]) ?>%</span>
<?php echo $h['unix']?> -
<?php echo $h['total_s']?>/
<?php echo $h['free_s']?>

</li>
<?php endforeach ?>
</ul>
