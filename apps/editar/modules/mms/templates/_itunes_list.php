<?php if(count($itunes) !== 0):?>
<?php echo __('La serie ya está publicada en iTunes.')?>

<ul style="padding-left: 20px;">
<?php foreach($itunes as $i): ?>
  <li>
    <a target="_back" href="http://deimos3.apple.com/WebObjects/Core.woa/Browse/uvigo.es.<?php echo $i->getItunesId() ?>"><?php echo __('Ver en iTunes U')?></a>
    (<?php echo $i->getCulture() ?> - 
     <?php echo $i->getItunesId() ?>)
  </li>
<?php endforeach ?>
</ul>
<?php endif?>