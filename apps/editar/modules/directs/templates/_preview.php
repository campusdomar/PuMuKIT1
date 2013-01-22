<!-- Vista previa -->
<?php if(isset($direct)):?>

<h3><?php echo $direct->getName()?></h3>
<?php echo $direct->getDescription()?>

<div style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:#DDD" >
  <div>
    URL: <a href="<?php echo sfConfig::get('app_info_link') . "/directo/index/id/" . $direct->getId()?>"> 
           <?php echo sfConfig::get('app_info_link') ?>/directo/index/id/<?php echo $direct->getId()?> 
         </a>
  </div>
  <div>
    IP fuente: <span style="font-style:italic"> <?php echo $direct->getIpSource()?> </span>
  </div>
  <div>
    Homapage player: <span style="font-style:italic"><?php echo $direct->getIndexPlay()?'Activo':'Desactivo'?></span>
  </div>
  <div>
    Estado: <span style="font-style:italic"><?php echo ($direct->getBroadcasting() == 0)?'Espera':'Emitiendo en directo'?></span>
  </div>
</div>


<br />
<a href="#" onclick="Effect.toggle('player','appear'); return false">Preview</a>  


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
  Selecione alguna directo.
</p>
<?php endif?>  
