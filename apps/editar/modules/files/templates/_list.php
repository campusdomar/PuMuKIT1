<table><tdody>
  <?php if(sfConfig::get('app_transcoder_use')):?>
    <?php foreach($transcodings as $transcoding):?>
      <tr>
        <td><ul><li></li><ul></td>
        <td colspan="9">
          <?php echo $transcoding->getStatusText()?>
          <?php if($transcoding->getStatusId() == TranscodingPeer::STATUS_ERROR) echo link_to_remote(image_tag('admin/mbuttons/use_inline.gif', 'alt=retranscodificar title=retranscodificar'), array('update' => 'files_mms', 'url' => 'transcoders/retrans?id='.$transcoding->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))?>
          <?php if($transcoding->getStatusId() == TranscodingPeer::STATUS_ERROR) echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=delete title=delete'), array('update' => 'files_mms', 'url' => 'transcoders/deletefromfile?id='.$transcoding->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))?>
        </td>
        <td>
          &nbsp;<?php echo $transcoding->getId(); ?> - <strong><?php echo $transcoding->getPerfil()->getName() ?></strong>
	  - <?php echo basename($transcoding->getPathini()) ?>
          - <?php echo $transcoding->getDurationString() ?>
        </td>
      </tr>
    <?php endforeach;?>
  <?php endif; ?>
  <?php $t = count($files) ; for( $i=0; $i<$t; $i++): $file = $files[$i] //idea primer y ultimo apate ?>  
    <tr>
      <td><ul><li></li><ul></td>
      <td><?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'files/edit?id='.$file->getId().'&mm='.$mm, array('title' => 'Editar Archivo de Mm '.$file->getId()), array('width' => '800')) ?></td>
      <td><?php echo m_link_to(image_tag('admin/mbuttons/info_inline.gif', 'alt=info title=info'), 'files/info?id='.$file->getId().'&mm='.$mm, array('title' => 'Info Archivo de Mm '.$file->getId()), array('width' => '800')) ?></td>
      <td><?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'files_mms', 'url' => 'files/delete?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true', 'confirm' => '&iquest;Seguro?'))?></td>
      <?php if (sfConfig::get('app_videoserv_browser')) echo '<td>'.link_to_remote(image_tag('admin/mbuttons/auto_inline.gif', 'alt=autocompletar title=autocompletar'), array('update' => 'files_mms', 'url' => 'files/autocomplete?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')).'</td>'?>
      <?php if (sfConfig::get('app_videoserv_browser')):?>
      <td>
        <span class="trans_button" onclick="$('list_picts_<?php echo $file->getId()?>').toggle()"><?php echo image_tag('admin/mbuttons/frame_inline.gif', 'alt=frame title=frame')?>
        <div class="trans_menu" id="list_picts_<?php echo $file->getId()?>" style="display:none">
        
          <div class="mas_info" style="">
            <div class="trans_button_up"><img src="/images/admin/mbuttons/frame_inline.gif" alt="frame" /></div>
            <div class="trans_button_info">Capturar frame de:</div>
          </div>
        
          <div class="list_options">
            <ul style="">
              <li><?php echo link_to_remote('Auto', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li><?php echo link_to_remote('10%', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true&numframe=10%', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li><?php echo link_to_remote('25%', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true&numframe=25%', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li><?php echo link_to_remote('50%', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true&numframe=50%', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li><?php echo link_to_remote('75%', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true&numframe=75%', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li><?php echo link_to_remote('90%', 
					    array('update' => 'pic_mms', 'url' => 'files/pic?id='.$file->getId().'&mm='.$file->getMmId().'&preview=true&numframe=90%', 'script' => 'true', 'loading' => '$("pic_mms_load").show()'))?></li>
              <li class="cancel"><a href="#" onclick="return false;">Cancelar...</a></li>
            </ul>
        
        
          </div>
        </div>
        </span>
      </td>






      <?php endif ?>
      <?php if (sfConfig::get('app_videoserv_browser')) echo '<td>'.link_to(image_tag('admin/mbuttons/download_inline.gif', 'alt=descargar title=descargar'), 'files/download?id='.$file->getId(), array('target' => '_blank')) .'</td>'?>
      
      

      <?php if(!$file->getPerfil()->getDisplay()): ?>
      <td>
        <span class="trans_button" onclick="$('list_perfiles_<?php echo $file->getId()?>').toggle()"><img src="/images/admin/mbuttons/use_inline.gif" alt="X" />
        <div class="trans_menu" id="list_perfiles_<?php echo $file->getId()?>" style="display:none">
        
          <div class="mas_info" style="">
            <div class="trans_button_up"><img src="/images/admin/mbuttons/use_inline.gif" alt="X" /></div>
            <div class="trans_button_info">Transcodificar al perfil:</div>
          </div>
        
          <div class="list_options">
            <ul style="">
              <?php foreach(PerfilPeer::doSelectToWizard(false) as $per): ?>
                <li><?php echo link_to_remote($per->getName(), 
					      array('update' => 'files_mms', 'url' => 'files/retrans?id='.$file->getId().'&mm='.$file->getMmId().'&profile='.$per->getId(), 'script' => 'true'))?></li>
              <?php endforeach ?>
              <li class="cancel"><a href="#" onclick="return false;">Cancelar...</a></li>
            </ul>
        
        
          </div>
        </div>
        </span>
      </td>

      <?php else: ?>

      <td>        
        <a title="reproducir" href="#" onclick="Shadowbox.open({
            title:      'Vista Previa',
            content:    '<?php echo $file->getUrl() ?>',
            type:       'flv',
            height:     480,
            width:      640
          }); return false;">
          <?php echo image_tag('admin/mbuttons/play_inline.gif', 'alt=reproducir title=reproducir')?>
        </a>
      </td>
      <?php endif ?>
      <td><?php echo (( $i == 0) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'files_mms', 'url' => 'files/up?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))))   ?></td>
      <td><?php echo (( $i == $t-1)? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'files_mms', 'url' => 'files/down?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')))) //dos espacios para misma anchura que flecha?></td>
      <td>
        &nbsp;<?php echo $file->getId(); ?> - <strong><?php echo $file->getPerfil()->getName() ?></strong>
        <?php echo $file->getDescription() ?>
        (<?php echo basename($file->getFile()) ?>/<?php echo $file->getLanguage()->getName() ?>)
         - <?php echo $file->getDurationString() ?>
         - <?php printf("%.2f", ($file->getSize() / 1048576)) ?> MB
         - <?php echo $file->getResolutionHor() ?>x<?php echo $file->getResolutionVer() ?>
         <?php echo ($file->getDisplay())?'':'(Oculto)'?>
      </td>
    </tr>
  <?php endfor; ?>
  <!-- MATTERHORN -->
  <?php if(sfConfig::get('app_matterhorn_use') && $oc):?>
      <tr>
        <td><ul><li></li><ul></td>
        <td><?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'matterhorn/edit?id='.$oc->getId(), array('title' => 'Editar Matterhorn de Mm '.$oc->getId()), array('width' => '800')) ?></td>
        <td><?php echo m_link_to(image_tag('admin/mbuttons/info_inline.gif', 'alt=info title=info'), 'matterhorn/infomp?id='.$oc->getId(), array('title' => 'Info Archivo OC de Mm '.$oc->getId()), array('width' => '800')) ?></td>

        <td colspan="8">&nbsp;<td>
        <td>
          &nbsp;<?php echo $oc->getId() ?> - <strong>Opencast Matterhorn Recording</strong>
          <a target="_blank" href="<?php echo $oc->getUrl() ?>"><?php echo $oc->getMhId() ?></a>
        </td>
      </tr>
    
  <?php endif ?>
  <!-- <tr>
    <td><ul><li></li><ul></td>
    <td colspan="9"><?php echo m_link_to('nuevo...', 'files/create?mm='.$mm, array('title' => 'Crear File'), array('width' => '800')) ?></td>
  </tr>-->
  <?php if(sfConfig::get('app_transcoder_use')): ?>
  <tr>
    <td><ul><li></li><ul></td>
    <td colspan="9"><?php echo m_link_to('nuevo master...', 'transcoders/edit?mm='.$mm, array('title' => 'Nuevo master'), array('width' => '800')) ?></td>
  </tr>
  <?php endif?>
</tbody></table>



<?php 
if ($sf_request->getParameter('preview')){
  echo javascript_tag(remote_function(array('update' => 'preview_mm', 'url' => 'mms/preview?id='. $mm, 'script' => 'true' )));
}

if (isset($msg_alert)) echo m_msg_alert($msg_alert);
?>
