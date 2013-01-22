<div class="mm_detail_item" onclick="new Ajax.Updater('info_video_bar', '<?php echo url_for('new_serial/infobar?id='.$mm->getId()) ?>');">
  <div class="mm_pic">
    <img src="<?php echo $mm->getFirstUrlPic() ?>" class="serial" style="width: 100px"/>
    <?php include_partial('new_serial/icons', array('mm' => $mm))?>
  </div> 
  <div class="mm_info">
    <div class="title">
      <?php echo $mm->getTitle() ?>
    </div>

    <div> 
      <?php echo $mm->getSubtitle() ?>
    </div>
    
    <div>
      <?php echo $mm->getFirstFile()->getDurationString() ?>
    </div>  

    <?php if($mm->getPrecinctId() !== 1): ?>
    <div class="serial_place">
      <?php echo $mm->getPrecinct()->getAllName()?>
    </div>
    <?php endif; ?>        


  </div>
</div>