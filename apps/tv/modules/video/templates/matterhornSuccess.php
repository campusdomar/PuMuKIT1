<?php // REVISAR indexSuccess.php para adaptar la salida matterhorn?>

<p class="titulo_widget titulo_widget_grande" style="margin-right: 10px;">
  <?php echo $mm->getTitle()?>
</p>



<div class="mm_player">
  <div class="date" style="margin-right: 10px;">
  <!-- Fixme falta estilo de esto -->
    <?php echo __('Fecha de celebración')?>: <?php echo $mm->getRecordDate('d/m/Y') ?>
  </div>
</div>


<script type="text/javascript">

//<![CDATA[
function mh_animacion(){

  player = $('mh_player');
  lateral = $('sidebar');
  if(player.hasClassName('fullscreen')){
    player.removeClassName('fullscreen');
    player.setStyle({'margin': '0px 247px 0px 0px'}); 
    lateral.setStyle({'width': '223px'});
    $('mh_toggle_img_1').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px 0px'});  
    $('mh_toggle_img_2').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px 0px'});  
    $('mh_toggle_img_3').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px 0px'});   
  }else{
    player.addClassName('fullscreen')
    lateral.setStyle({'width': '19px'}); 
    player.setStyle({'margin': '0px 40px 0px 0px'}); 
    $('mh_toggle_img_1').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px -16px'});  
    $('mh_toggle_img_2').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px -16px'});  
    $('mh_toggle_img_3').setStyle({'background': 'transparent  url("/images/tv/iconos/flechas.png") no-repeat -22px -16px'}); 
  }
  return false;

}

//]]>
</script>

<div id="bloque" style="width: auto;">
 <div id="usctv_m_mmobj" class="usctv_m" style="margin: 0px 1%; padding: 20px 0px;">


  <div id="sidebar" > 
    <div id="mh_toggle_div" onclick="mh_animacion();" >


    <div id="mh_toggle_img_1" class="mh_toggle_img"
         style="top:25%; ">
         &nbsp;
    </div>

    <div id="mh_toggle_img_2" class="mh_toggle_img"
         style="top:50%; ">
         &nbsp;
    </div>

    <div id="mh_toggle_img_3" class="mh_toggle_img"
         style="top:75%; ">
         &nbsp;
    </div>
  </div>
  <div id="sidebar_content" style="width: 100%">
 <?php include_partial('video/other', array('texto' => __('Vídeos de la misma serie:'), 
					      'mmobjs' => PubChannelPeer::getMmsFromSerial(1, $mm->getSerialId())))?>
   <?php include_partial('video/other', array('texto' => __('Tamén te interesan:'), 
					      'mmobjs' => $mm->getSimilarMms()))?>
  </div>
 </div>    




  <div id="mh_player">

    <iframe src="<?php echo $oc->getIframeUrl($mm->getBroadcast()->getBroadcastType())?>" 
            id="mh_iframe"
            style="border:0px #FFFFFF none; width:100%; height:760px;" 
            name="Opencast Matterhorn - Media Player" 
            scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" 
            webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true"
            >
    </iframe>

    <div class="mm_player">
      <div class="num_view">
        <div style="float:left">
          <?php echo __("Idioma del video")?>: <span class="num_view_number"><?php echo $oc->getLanguage() ?></span>
        </div>
        <?php echo __('Visto:')?> 
        <span class="num_view_number"><?php echo $oc->getNumView()?></span>
        <?php echo (($oc->getNumView() == 1)?__(' vez'):__(' veces'))?> &nbsp;&nbsp;
      </div>
    </div>

    <div class="title">
      <?php echo $mm->getSubtitle() ?>
    </div>

    <p class="description">
      <?php echo $mm->getDescription() ?>
    </p>

    <?php include_partial('video/bodyMm', array('mm' => $mm, 'roles' => $roles)) ?>

  </div>

 </div>
</div>


