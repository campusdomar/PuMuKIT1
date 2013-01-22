<h2><?php echo __('Más Vistos en') ?> <?php setlocale(LC_ALL, $sf_user->getCulture().'_ES.UTF8'); echo strftime('%B', mktime(0,0,0,date('m')-1,1,2000))?></h2>

<div id="masvistos">
<?php foreach ($mms as $mm): ?>
<?php include_partial('global/masvistos', array( 'mm' => $mm)) ?>
  <?php endforeach ?>
</div>


