<div id="body_div">
<div id="cab" style="">
<h1>Uvigo-TV</h1>
</div>

<div id="menu">
  <?php include_partial('new_serial/menu') ?>
</div>

<div id="header_serie" style="">
  <?php include_partial('new_serial/header_serial', array('serial' => $serial)) ?>
</div>

<div id="row_right">
<div id="info_video_bar">
  <?php include_partial('new_serial/info_video_bar', array('mm' => $mms[0])) ?>
</div>

<div id="serials_bar">
<?php include_partial('new_serial/list_serial', array('mms' => $mms, 'roles' => $roles)) ?>
</div>

<div>

</div>
<div>

</div>
</div>

<div id="row_left">
  <?php include_partial('new_serial/video', array('mm' => $mms[0], 'roles' => $roles)) ?>
</div>


<div id="footer_serie" style="">
  <?php include_partial('new_serial/channels') ?>
</div>

<div id="footer" style="background-color: #AAA">
FOOTER
</div>
</div>