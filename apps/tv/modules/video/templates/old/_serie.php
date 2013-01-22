<a href="/"><?php echo sfConfig::get('app_metas_title')?></a> >>
<a href="<?php echo url_for('serial/index?id=' . $mm->getSerialId())?>"><?php echo $mm->getSerial()->getTitle() ?></a>


<div  style="height: 300px; overflow-y: scroll">
  <?php include_partial('announce', array('announces' => $mms)) ?>
</div>
