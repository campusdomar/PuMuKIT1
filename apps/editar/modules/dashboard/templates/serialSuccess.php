<data>
  <?php foreach($serials as $serial):?>
    <event
        start="<?php echo $serial->getPublicdate('M j Y 00:00:00 \G\M\T')?>"
        title="<?php echo str_replace('"', "'", $serial->getTitle()) ?>"
        link="<?php echo sfConfig::get('app_info_link')?>/serial/index/id/<?php echo $serial->getId() ?>"
        >

      <?php echo $serial->getTitle() ?>
    </event>
  <?php endforeach; ?>
</data>