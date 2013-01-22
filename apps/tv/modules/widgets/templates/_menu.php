<h2><?php echo __('Menú') ?></h2>

<div id="menu">
  <ul>

<!-- INDEX -->
    <li>
<?php echo link_to((($value == 'index')? '<strong>'.__('Principal').'</strong>' : __('Principal')), 'index/index')?>
    </li>

<!-- Announces -->
    <li>
<?php echo link_to((($value == 'announces')? '<strong>'.__('Novedades').'</strong>' : __('Novedades')), 'announces/index')?>
    </li>

<!-- News -->
    <li>
<?php echo link_to((($value == 'news')? '<strong>'.__('Noticias').'</strong>' : __('Noticias')), 'news/index')?>
    </li>

<!-- Directos -->
<?php foreach($directs as $direct): ?>
    <li>
      <?php echo link_to(((($value == 'directo')&&($sf_params->get('canal', 0) == $direct->getId()))? '<strong>'.$direct->getName().'</strong>' : $direct->getName()), 'directo/index?canal='.$direct->getId())?>
    </li>
<?php endforeach; ?>

<!-- Mediateca -->
    <li>
<?php echo link_to((($value == 'library')? '<strong>'.__('Mediateca').'</strong>' : __('Mediateca')), 'library/abc')?>
    </li>

<!-- Mediateca Pri-->
<?php if($sf_user->hasCredential('pri')):?>
   <li>
      <?php echo link_to((($value == 'library')? '<strong>'.__('Med. Privada').'</strong>' : __('Med.Privada')), 'library/abc?broadcast=pri') ?>
    </li>
<?php endif?>


<!-- Templates -->
<?php foreach($templates as $template):?>
      <li>
<?php echo link_to(( ($value == $template->getName())? '<strong>'.$template->getName().'</strong>' : $template->getName()), 'templates/index?temp='.$template->getName())?>
      </li>
<?php endforeach; ?>

  </ul>
</div>
