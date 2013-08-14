<h1 class="video_title">
   <span>Vídeo </span><?php echo $m->getTitle() ?>
</h1>



<div id="usctv_m_mmobj" class="usctv_m">

  <div class="grid_10">
    <?php include_partial('player', array('mmobj' => $m, 'file' => $file, 'roles' => $roles))?>
    <div style="padding: 30px 0px 0px">
      <?php //include_component('index', 'tabs', array('show_ground' => false))?>
      <?php include_component('widgets', 'announcesv2') ?>
    </div>
  </div>

  <div class="grid_5">
   <!-- FIXME. mostrar solo objetos multimedia publicos -->
   <?php include_partial('other', array('texto' => __('Vídeos de la misma serie:'), 
					      'mmobjs' => PubChannelPeer::getMmsFromSerial(1, $m->getSerialId())))?>
   <?php include_partial('other', array('texto' => __('También te interesan:'), 
					      'mmobjs' => $m->getSimilarMms()))?>
   <?php include_partial('share', array('mmobj' => $m, 'file' => $file))?>
  </div>
</div>

<div style="clear:both"></div>

