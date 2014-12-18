<div>
<h1><?php echo $vcat->getName() ?></h1>
</div>

<ul style="list-style-image:none; list-style-position:outside; list-style-type:none;">
  <?php $num = 0; foreach($sub_cats as $sc): $mms = $sc->getMms(); if(count($mms) == 0) continue;?>
    <li> - 
        <a href="#<?php echo $sc->getCod()?>"><?php echo str_replace($vcat->getName(). ' - ', '', $sc->getName())?></a> 
        [<?php echo $num += $sc->countMms() ?> V&iacute;deos]
    </li>
  <?php endforeach ?>
</ul>

<br /><br /><br />
<?php foreach($sub_cats as $sc): $serials = $sc->getSerials(); if(count($serials) == 0) continue;?>
  <a name="<?php echo $sc->getCod()?>"></a>
  <div style="margin: 5px 0px 15px">
    <!-- <div style="color:  #fff; background-color: #039; font-weight: bold; font-size: 130%; padding: 10px">
      <?php echo str_replace($vcat->getName(). ' - ', '', $sc->getName())?>
    </div> -->

    <h2 class="nada">
      <span><?php echo str_replace($vcat->getName(). ' - ', '', $sc->getName())?><span>
    </h2> 

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

    </div>
<?php endforeach ?>


<?php if(0 == $num): ?>
  <?php echo __('No existen vídeos en esta categoría'); ?>
<?php endif ?>
