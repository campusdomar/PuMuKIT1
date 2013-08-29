<div>
  <img id="pic_mms_load" src="/images/admin/load/spinner.gif" alt="loading" style="position: relative; top: 50px; float:left; display: none"/>
  <?php $total = count($pics) ; for($i=0; $i < $total; $i++): $pic = $pics[$i] ?>
    <div style="width : 120px; float: left; padding : 10px; ">
     <div style="padding: 10px; float:left; text-align : center">
      <div class="wrap0"><div class="wrap1"><div class="wrap2"><div class="wrap3">
          <img src="<?php echo $pic->getUrl() ?>" width="100" height="82" border="1">
      </div></div></div></div>
     </div>
      <div style="text-align : center">
         Imagen numero <?php echo $pic->getId() ?>  <br />
  
         <?php if ($i != 0) echo link_to_remote('&#8592;', array('update' => 'pic_'.$que.'s', 'url' => 'pics/up?id='. $pic->getId() .'&'.$que.'='. $object_id, 'script' => 'true'))?>
         <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'pic_'.$que.'s', 'url' => 'pics/delete?id='. $pic->getId() .'&'.$que.'='. $object_id, 'script' => 'true', 'confirm' => '&iquest;Seguro?'))?>
         <?php if ($i != $total - 1 ) echo link_to_remote('&#8594;', array('update' => 'pic_'.$que.'s', 'url' => 'pics/down?id='. $pic->getId() .'&'.$que.'='. $object_id, 'script' => 'true'))?>
         
      </div>
    </div>
  <?php endfor;?>


</div>
  <div style="width : 120px; float: left; padding : 10px; ">
    <div style="padding: 10px; float:left; text-align : center">
     <div class="wrap0"><div class="wrap1"><div class="wrap2"><div class="wrap3">
         <img src="/images/sin_foto.jpg" width="100" height="82" border="1">
      </div></div></div></div>
     </div>

    <div style="text-align : center">
      <?php echo m_link_to('nueva imagen...', 'pics/create?'.$que.'='. $object_id. '&page=1', array('title' => 'Nueva Imagen'), array('width' => '800'))?>
    </div>
  </div>

<div style="clear : left"></div>

<?php 
if (($sf_request->getParameter('preview'))||((isset($preview))&&($preview))){
  echo javascript_tag('update_preview(' . $object_id . ');');
}

if (isset($msg_alert)) echo m_msg_alert($msg_alert) 
?>
