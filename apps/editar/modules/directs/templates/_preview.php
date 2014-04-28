<!-- Vista previa -->
<?php if(isset($direct)):?>

<h3><?php echo $direct->getName()?></h3>
<?php echo $direct->getDescription()?>

<div style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:#DDD" >
  <div>
    <?php echo __('URL:')?> <a href="<?php echo sfConfig::get('app_info_link') . "/directo/index/id/" . $direct->getId()?>"> 
           <?php echo sfConfig::get('app_info_link') ?>/directo/index/id/<?php echo $direct->getId()?> 
         </a>
  </div>
  <div>
    <?php echo __('IP fuente:')?> <span style="font-style:italic"> <?php echo $direct->getIpSource()?> </span>
  </div>
  <div>
    <?php echo __('Mostrar reproductor en página de inicio:')?> <span style="font-style:italic"><?php echo $direct->getIndexPlay()?__('Activado'):__('Desactivado')?></span>
  </div>
  <div>
    <?php echo __('Estado:')?> <span style="font-style:italic"><?php echo ($direct->getBroadcasting() == 0)?__('Espera'):__('Emitiendo en directo')?></span>
  </div>
</div>


<br />
<a href="#" onclick="Effect.toggle('player','appear'); return false"><?php echo __('Preview')?></a>  


<div id="player" style="display: none;">  
  <?php     
    switch ($direct->getDirectType()) {
     case 'WMS':
       include_partial('directs/asx', array('url' => $direct->getUrl(), 'hor' => '320', 'ver' => '230'));
       break;
     case 'FMS':
       include_partial('directs/flv', array('url' => $direct->getUrl(), 'hor' => '320', 'ver' => '230'));
       break;
     default:
       echo $direct->getUrl();
       break;
    }
  ?>
</div>

<?php else:?>
<p>
  <?php echo __('Seleccione algún directo.')?>
</p>
<?php endif?>  
