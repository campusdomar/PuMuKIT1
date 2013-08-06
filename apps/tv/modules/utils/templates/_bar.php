<?php foreach ($widgets as $w): ?>
  <div class="widget_<?php echo $bar?>" id="<?php echo  $w->getWidget()->getName() ?>">
    <?php include_component('widgets', $w->getWidget()->getName() ) ?>
  </div>
<?php endforeach ?>
<?php if($bar == "Footerbar"): ?>
  <div style="clear:both; text-align: right; padding: 10px 0px 0px 10px;">
    <img style="width: 10px;" src="/favicon.ico">
    <a style="color: #000; text-decoration: none" href="http://pumukit.org">
    Powered by
    <span style="font-style: italic">PumuKIT</span>
    </a>
  </div>
<?php endif ?>