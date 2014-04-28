<div style="background-color: red; padding: 5px; "> <?php echo __('Objetos multimedia más vistos')?> </div>

<ol>
<?php foreach($mms as $mm): ?>
  <li> 
    <?php echo $mm->getId() ?>.- <?php echo $mm->getTitle() ?>
  </li>
<?php endforeach ?>
</ol>
