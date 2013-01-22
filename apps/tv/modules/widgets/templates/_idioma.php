<div>
<?php foreach($langs as $lang): ?>
  <div>
    <?php echo link_to(image_tag('/images/tv/culture/' . $lang . '.gif', 'border=0 alt=' . $lang), 'utils/culture?culture=' . $lang)?>
  </div>
<?php endforeach; ?>
</div>