<?php use_javascript('/swf/jwplayer6/jwplayer.js') ?>

<video id="player1" controls>
</video>
<?php echo "Debug: la url original es: " . $file->getUrl() . "\n<br/>";
      echo "la url generada con getinternalurl(true) es: " . $file->getInternalUrl(true) . "\n<br/>"; ?>
    
<script language="JavaScript" type="text/javascript">
jwplayer("player1").setup({
  modes: [
     { type: 'html5', src: '/swf/jwplayer6/jwplayer.html5.js' },
     { type: 'flash', src: '/swf/jwplayer6/jwplayer.flash.js' }
  ],
        file: '<?php echo $file->getUrl() ?>',
        title: '<?php echo $mmobj->getTitle()?>',
          <?php $captions = $mmobj->getCaptions(); 
          if ($captions != null):?>
        tracks: [{ 
            file: "<?php echo $captions->getInternalUrl(true)?>", 
            label: "Subtitulos",
            kind: "captions"
        }],
          <?php endif?>
  startparam: 'start',
      <?php $pic = $mmobj->getFirstUrlPic();?>
      <?php if ($file->getAudio()) :?>
        <?php if ( $pic != NULL && !strpos($pic, 'images/sound_bn.png')):?>
          image: '<?php echo $pic?>',
        <?php else: // Sustituir por imagen personalizada para audios?>
          image: '/images/sound_bn.png',
        <?php endif;?>
      <?php elseif ($noautostart): ?>
        image: '<?php echo $pic ?>',
      <?php endif;?>
<?php /* Para añadir una mosca con enlace.   
      logo: {
      file: "/images/iconos/mosca.png",
      link: "http://www.url.com"
    }, */ ?>
  repeat: 'false',
  <?php if (!$noautostart) :?>
    autostart: 'true',
  <?php endif;?>
    width: <?php echo $w?>,
    height: <?php echo $h?>
});
</script> 