<table><tdody>
  <?php $t = count($links) ; for( $i=0; $i<$t; $i++): $link = $links[$i] //idea primer y ultimo apate ?>  
    <tr>
      <td><ul><li></li><ul></td>
      <td><?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'links/edit?id='.$link->getId().'&mm='.$mm, array('title' => __('Editar archivo de objeto multimedia ').$link->getId()), array('width' => '800')) ?><td>
      <td><?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'links_mms', 'url' => 'links/delete?id='.$link->getId().'&mm='.$mm.'&preview=true', 'script' => 'true', 'confirm' => __('&iquest;Seguro?')))?></td>
      <td><?php echo (( $i == 0) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'links_mms', 'url' => 'links/up?id='.$link->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))))   ?></td>
      <td><?php echo (( $i == $t-1)? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'links_mms', 'url' => 'links/down?id='.$link->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')))) //dos espacios para misma anchura que flecha?></td>
      <td>&nbsp;<?php echo $link->getId(); ?> - <?php echo $link->getUrl(); ?></td>
    </tr>
  <?php endfor; ?>
  <tr>
    <td><ul><li></li><ul></td>
    <td colspan="6"><?php echo m_link_to(__('nuevo...'), 'links/create?mm='.$mm, array('title' => __('Crear Link')), array('width' => '800')) ?></td>
  </tr>
</tbody></table>


<?php 
if ($sf_request->getParameter('preview')){
  echo javascript_tag("update_preview(" . $mm . ");");
}

if (isset($msg_alert)) echo m_msg_alert($msg_alert)
?>
