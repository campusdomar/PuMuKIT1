<div class="pumukit_mmobjs">
   <?php foreach($mmobjs as $ii => $mmobj):?>


<div class="pumukit_mmobj">

<?php if($mmobj->getSerialId() != $mmobj->getId()): ?>
  <div class="thumbnail">
    <a href="<?php echo $mmobj->getUrl()?>" >
      <img class="play_icon" alt="" src="/images/tv/iconos/play_icon.png" />
      <img alt="serial_pic" class="serial" src="<?php echo $mmobj->getFirstUrlPic()?>"/>
    </a>
  </div>
<?php else: ?>
  <figure class="album" style="margin:2px 20px 2px 2px; ">
    <a href="<?php echo $mmobj->getUrl()?>">
      <div class="picture"><img src="<?php echo $mmobj->getFirstUrlPic() ?>" /></div>
      <div class="picture"><img src="<?php echo $mmobj->getFirstUrlPic() ?>" /></div>
      <div class="picture"><img src="<?php echo $mmobj->getFirstUrlPic() ?>" /></div>
    </a>
  </figure>
 <?php endif ?>


  <div class="info">
    <div class="title">
      <a href="<?php echo $mmobj->getUrl()?>" >
        <!-- <?php $t = $mmobj->getTitle(); $aux = @strpos($t, ' ', 250); echo substr_replace($t, '...', $aux?$aux:250)?> -->
        <?php echo $mmobj->getTitle() ?>
      </a>
    </div>

    <div class="serial_title">
      <?php if(strlen($mmobj->getLine2()) > 1): ?>
        <?php echo $mmobj->getLine2() ?>      
      <?php elseif(strlen($mmobj->getSerial()->getTitle()) < 27):?>
        <?php echo $mmobj->getSerial()->getTitle() ?>
      <?php else:?>
        <abbr title="<?php echo $mmobj->getSerial()->getTitle() ?>">
          <?php $t = $mmobj->getSerial()->getTitle(); $aux = @strpos($t, ' ', 27); echo substr_replace($t, '...', $aux?$aux:27)?>
        </abbr>
      <?php endif?>
    </div>

    <div class="date">
   <?php echo $mmobj->getRecordDate('d/m/Y') ?>
    </div>

  </div>

</div>



<?php endforeach?>
</div>