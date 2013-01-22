<div id="player">
  <?php include_partial('new_serial/wmplayer', array('file' => $mm->getFirstFile())) ?>
</div>

<div id="info_video">
  <?php include_partial('new_serial/info_video', array('mm' => $mm, 'roles' => $roles)) ?>
</div>
