<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold"><?php echo __('INFO LOS TRANSCODIFICADORES')?></legend>

<span style="font-weight: bold">JOBS</span>
<ul style="margin-left: 15px;">
  <li><?php echo __('Pausados:')?> <?php echo $t_pausado?></li>
  <li><?php echo __('Esperando:')?> <?php echo $t_stop?></li>
  <li><?php echo __('Ejecutandose:')?> <span style="font-weight: bold"><?php echo $t_ejec?></span></li>
  <li><?php echo __('Correctos:')?> <?php echo $t_fin?></li>
  <li><?php echo __('Error:')?> <?php echo $t_error?></li>
</ul>

<br />
<span style="font-weight: bold">CPUS</span>
<ul style="margin-left: 15px;">
  <?php foreach($cpus as $cpu): ?>
  <li>
    <?php echo $cpu->getIp()?>  
    <?php echo $cpu->getMin()?>/<span style="font-size: 125%; font-weight: bold"><?php echo $cpu->getNumber()?></span>/<?php echo $cpu->getMax()?>
    <?php if($cpu->isActive()):?>
       <?php for($i = 0; $i < $cpu->getNumUsed(); $i++): ?><span style="color:red">&bull;</span> <?php endfor?>
       <?php for($i = $cpu->getNumUsed(); $i < $cpu->getNumber(); $i++): ?><span style="color:blue">&bull;</span> <?php endfor?>
       <?php for($i = $cpu->getNumber(); $i < $cpu->getMax(); $i++): ?><span style="color:grey">&bull;</span> <?php endfor?>
    <?php else:?>
      <span style="color:red">KO</span>
    <?php endif?>
  </li>
  <?php endforeach ?>
</ul>

</fieldset>