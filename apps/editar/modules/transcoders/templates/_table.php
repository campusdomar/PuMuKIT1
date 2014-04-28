<tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($transcoder->getId() == $sf_user->getAttribute('id', null, 'tv_admin/transcoder')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $transcoder->getId()?>" class="<?php echo $checkbox_name?>_checkbox" type="checkbox">
      </td>
     <!--  <td onclick="click_fila('transcoder', this, <?php //echo $transcoder->getId() ?>);"> -->
     <td>
        <?php 
           switch ($transcoder->getStatusId()) {
             case 0:
               $foto='pause_foto.png';
               echo link_to_remote(image_tag('admin/mbuttons/play_inline.gif', 'alt=' . __('pausar') . ' title=' . __('pausar')), array('update' => 'list_transcoders', 'url' => 'transcoders/continue?id='.$transcoder->getId(), 'script' => 'true', 'confirm' => __('Seguro')));
               break;
             case 1:    
               $foto='wait_foto.png';
               echo link_to_remote(image_tag('admin/mbuttons/pause_inline.gif', 'alt=' . __('reanudar') . ' title=' . __('reanudar')), array('update' => 'list_transcoders', 'url' => 'transcoders/pause?id='.$transcoder->getId(), 'script' => 'true', 'confirm' => __('Seguro')));               
               break;
             case 2:
               $foto='use_foto.png';
               echo image_tag('admin/mbuttons/use_inline.gif', 'alt=' . __('transcodificando') . ' title=' . __('transcodificando'));
               break;
            case 3:
               $foto='ok_foto.png';
               echo image_tag('admin/mbuttons/ok_inline.gif', 'alt=' . __('finalizado') . ' title=' . __('finalizado'));
               break;
            default:
              $foto='ko2_foto.png';
              echo image_tag('admin/mbuttons/ko_inline.gif', 'alt=' . __('error') . ' title=' . __('error'));
          } 
        ?>
      </td>
      <td>
        <?php 
           if (1 == $transcoder->getStatusId()) echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_transcoders', 'url' => 'transcoders/delete?id='.$transcoder->getId(), 'script' => 'true', 'confirm' => __('Seguro')));
          else echo image_tag('admin/mbuttons/use_inline.gif', 'alt=' . __('pausar') . ' title=' . __('pausar'));
          //else echo '&nbsp;&nbsp;&nbsp;';     
        ?>
      </td>
      <td>
         <?php
           if (($transcoder->getStatusId() < 3)&&($transcoder->getStatusId() > -1 )){
             if ($transcoder->hasEmailon()){ 
               echo link_to_remote(image_tag('admin/mbuttons/email_inline_on.gif', 'alt=' . __('email') . ' title=' . __('emailOK')), array('update' => 'list_transcoders', 'url' => 'transcoders/altermail?id='.$transcoder->getId(), 'script' => 'true', 'confirm' => __('Seguro')));
             }
             else echo link_to_remote(image_tag('admin/mbuttons/email_inline_off.gif', 'alt=' . __('email') . ' title=' . __('emailOFF')), array('update' => 'list_transcoders', 'url' => 'transcoders/altermail?id='.$transcoder->getId(), 'script' => 'true', 'confirm' => __('Seguro')));
           }
           else{
             if ($transcoder->hasEmailon()) echo image_tag('admin/mbuttons/email_inline_on.gif', 'alt=' . __('email') . ' title=' . __('emailOK'));
             else echo image_tag('admin/mbuttons/email_inline_off.gif', 'alt='  . __('email') . ' title=' . __('emailOFF'));
           }
          ?>
      </td>
      <td>
         <?php
           if ((($transcoder->getStatusId() == 1)||($transcoder->getStatusId() == 0))&&($transcoder->getPriority()<3)){ 
              echo link_to_remote(image_tag('admin/transcoder/subir.png', 'alt=' . __('subir') . ' title=' . __('subir')), array('update' => 'list_transcoders', 'url' => 'transcoders/priorityup?id='.$transcoder->getId(), 'script' => 'true'));
           }
           else echo image_tag('admin/transcoder/subir_off.png', 'alt=' . __('subir') . ' title=' . __('subir'));
         ?>
      </td>
      <td>
         <?php echo $transcoder->getPriority(); ?>
      </td>   
      <td>
        <?php
          if ((($transcoder->getStatusId() == 1)||($transcoder->getStatusId() == 0))&&($transcoder->getPriority()>1)){ 
            echo link_to_remote(image_tag('admin/transcoder/bajar.png', 'alt=' . __('bajar') . ' title=' . __('bajar')), array('update' => 'list_transcoders', 'url' => 'transcoders/prioritydown?id='.$transcoder->getId(), 'script' => 'true'));
          }
          else echo image_tag('admin/transcoder/bajar_off.png', 'alt=' . __('bajar') . ' title=' . __('bajar'));
        ?>
      </td>
      
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php echo image_tag('admin/transcoder/'.$foto, 'title=' . __('estado') . ' alt=' . __('Sin_foto')); ?>
     </td>   
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php echo $transcoder->getId() ?>
     </td> 
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php echo $transcoder->getPathini(); ?>
     </td> 
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php echo $transcoder->getPerfil()->getName() ?>
     </td> 
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php $aux = $transcoder->getRatio(); echo ($aux == 0.0)?'?':($transcoder->getRatio()*100).'%' ?>
     </td> 
     <td onclick="click_fila('transcoder', this, <?php echo $transcoder->getId() ?>);">
        <?php echo $transcoder->getTimeini() ?>
     </td>  
    </tr>