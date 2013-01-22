<table><tdody>
  <?php $t = count($files) ; for( $i=0; $i<$t; $i++): $file = $files[$i] //idea primer y ultimo apate ?>  
    <tr>
      <td><ul><li></li><ul></td>
      <td><?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'files/edit?id='.$file->getId().'&mm='.$mm, array('title' => 'Editar Archivo de Mm '.$file->getId()), array('width' => '800')) ?><td>
      <td><?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'files_mms', 'url' => 'files/delete?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true', 'confirm' => 'Seguro'))?></td>
      <?php if (sfConfig::get('app_videoserv_browser')) echo '<td>'.link_to_remote(image_tag('admin/mbuttons/auto_inline.gif', 'alt=autocompletar title=autocompletar'), array('update' => 'files_mms', 'url' => 'files/autocomplete?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')).'</td>'?>
      <td><?php echo (( $i == 0) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'files_mms', 'url' => 'files/up?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))))   ?></td>
      <td><?php echo (( $i == $t-1)? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'files_mms', 'url' => 'files/down?id='.$file->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')))) //dos espacios para misma anchura que flecha?></td>
      <td>&nbsp;<?php echo $file->getId(); ?> - <?php echo $file->getUrl(); ?></td>
    </tr>
  <?php endfor; ?>
  <tr>
    <td><ul><li></li><ul></td>
    <td colspan="6"><?php echo m_link_to('nuevo...', 'files/create?mm='.$mm, array('title' => 'Crear File'), array('width' => '800')) ?></td>
  </tr>
</tbody></table>



<?php 
if ($sf_request->getParameter('preview')){
  echo javascript_tag(remote_function(array('update' => 'preview_mm', 'url' => 'mms/preview?id='. $mm, 'script' => 'true' )));
}
?>
