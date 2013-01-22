<div class="pumukit_mini_mmobjs">
<?php foreach($mmobjs as $mmobj):?>

<dl class="pumukit_mini_mmobj">

  <dt class="thumbnail">
    <a href="<?php echo url_for('video/index?id=' . $mmobj->getId())?>" >
      <img class="play_icon" alt="" src="/images/tv/iconos/play_icon.png" />
      <img class="mm_img" src="<?php echo $mmobj->getFirstUrlPic()?>" width="75 px" height="56 px"/>
    </a>
  </dt> 

  <dd class="info">
    <div class="title">
      <a href="<?php echo url_for('video/index?id=' . $mmobj->getId())?>" >
        <?php $t = $mmobj->getTitle(); $aux = @strpos($t, ' ', 50); echo substr_replace($t, '...', $aux?$aux:50)?>
      </a>
    </div>


    <div class="mini_mmobj_bottom">
      <?php include_partial('global/grounds', array('show_ground' => true, 'grounds' => $mmobj->getGroundsWithI18n()))?>
    </div>
  </dd>

</dl>


<?php endforeach?>
</div>