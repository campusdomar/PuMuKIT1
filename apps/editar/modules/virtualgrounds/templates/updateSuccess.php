<?php echo javascript_tag("
  parent.$('ground_img_" . $vground->getId() . "').src='" . $vground->getImg() . "';
  //parent.location.href='".url_for('virtualgrounds/index')."';"
)?>