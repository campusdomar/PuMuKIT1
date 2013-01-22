<?php if(count($itunes) !== 0):?>
La serie ya esta publicada en itunes.

<ul style="padding-left: 20px;">
<?php foreach($itunes as $i): ?>
  <li>
    <a target="_back" href="http://deimos3.apple.com/WebObjects/Core.woa/Browse/uvigo.es.<?php echo $i->getItunesId() ?>">Ver en itunes u</a>
    (<?php echo $i->getCulture() ?> - 
     <?php echo $i->getItunesId() ?>)
  </li>
<?php endforeach ?>
</ul>
<?php endif?>