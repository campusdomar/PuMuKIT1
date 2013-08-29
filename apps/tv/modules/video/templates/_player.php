<div class="mm_player">
  <?php include_partial('playerhtml5', array('file' => $file, 'w' => 620, 'h' => 465, 'mmobj' => $mmobj, 'noautostart' => false))?>
  <br />
  <?php include_partial('bodyMm', array('mm' => $mmobj, 'file' => $file, 'roles' => $roles)) ?>
</div>
