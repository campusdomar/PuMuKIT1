<?php if(count($serials) == 0):?>
  <?php echo __('Sin resultado')?>
<?php else:?>
  <ul style="margin-left: 15px;">
  <?php foreach($serials as $s):?>
    <li>
      <a href="<?php echo url_for('mms/index?serial=' . $s->getId()) ?>">
      <?php echo str_replace($name, '<strong>'.$name.'</strong>', $s->getTitle())?></a>
      (<?php echo $s->getPublicdate('d/m/Y')?>)
    </li>
  <?php endforeach?>
  </ul>
<?php endif ?>
