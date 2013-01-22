<div id="masvisto">
  <?php echo link_to(image_tag($mm->getLastUrlPic()), 'serial/index?id=' . $mm->getSerialId()) ?>
  <div>
    <span id="person"><?php echo $mm->getLine2Basic()?></span>
    <span id="title"><?php echo $mm->getTitle()?></span>
  </div>
  <div id="ver"><?php echo link_to('[Ver]', 'serial/index?id=' . $mm->getSerialId()) ?></div>
</div>

