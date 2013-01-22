<ul>
  <?php foreach ($persons as $person): ?>
    <li><?php echo $person->getId()?> - <?php echo str_replace($name, '<strong>'.$name.'</strong>', $person->getName()) ?>
      <span style="font-size: 75%; "><?php echo $person->getInfo()?><span>
    </li>
  <?php endforeach; ?>
</ul>
