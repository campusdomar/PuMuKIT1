<?php use_javascript('jwplayer.js') ?>

<video id="player"  src="<?php echo $file->getUrl() ?>" controls style="background: black; width: 100%;" <?php echo ($file->getAudio()?'poster="/images/1.8/sound_bn.png"':'') ?> >
  <?php $cap = $file->getMm()->getCaptions(); if($cap):?>
    <track kind="subtitles" src="<?php echo $cap->getUrl()?>" srclang="es" />
  <?php endif?>
</video>