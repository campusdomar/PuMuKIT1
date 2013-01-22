<h2>Mas vistos total</h2>

<div id="masvistos">
<?php foreach ($mms as $mm): ?>
<?php include_partial('global/masvistos', array( 'mm' => $mm)) ?>
  <?php endforeach ?>
</div>


