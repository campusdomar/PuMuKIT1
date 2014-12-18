<?php use_javascript('jwplayer.js') ?>

<video id="player1" width="620" height="465" controls>
  <source src="<?php echo $file->getUrl() ?>" type="video/mp4" />
</video>
<script type="text/javascript">
  jwplayer("player1").setup({
    modes: [
	    { type: 'html5' },
	    { type: 'flash', src: '/swf/player.swf' }
	    ],
    <?php if(sfConfig::get('app_intro_use')):?>  
    playlist: [{
               'file': '<?php echo sfConfig::get('app_intro_url')?>',
                 'title': 'Intro'
                 },{
               'file': '<?php echo $file->getUrl() ?>',
                 'title': 'video'
                 }],
    <?php endif ?>
    skin: '/images/skins/newtubedark/newtubedark.zip',
    controlbar: 'bottom',
    repeat: 'list',
    stretching: 'exacfit',
    autoplay: 'true'
  });
</script>