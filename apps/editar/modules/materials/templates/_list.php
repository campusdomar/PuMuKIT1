<table><tdody>
  <?php $t = count($materials) ; for( $i=0; $i<$t; $i++): $material = $materials[$i] //idea primer y ultimo apate ?>  
    <tr>
      <td><ul><li></li><ul></td>
      <td><?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'materials/edit?id='.$material->getId().'&mm='.$mm, array('title' => 'Editar Archivo de Mm '.$material->getId()), array('width' => '800')) ?><td>
      <td><?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'materials_mms', 'url' => 'materials/delete?id='.$material->getId().'&mm='.$mm.'&preview=true', 'script' => 'true', 'confirm' => '&iquest;Seguro?'))?></td>
      <td><?php echo link_to(image_tag('admin/mbuttons/download_inline.gif', 'alt=descargar title=descargar'), $material->getUrl(true), array('target' => '_blank'))?></td>
      <td><?php echo (( $i == 0) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'materials_mms', 'url' => 'materials/up?id='.$material->getId().'&mm='.$mm.'&preview=true', 'script' => 'true'))))   ?></td>
      <td><?php echo (( $i == $t-1)? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'materials_mms', 'url' => 'materials/down?id='.$material->getId().'&mm='.$mm.'&preview=true', 'script' => 'true')))) //dos espacios para misma anchura que flecha?></td>
      <td>
        &nbsp;
        <?php echo $material->getId(); ?> - 
        <?php echo $material->getName(); ?>
        <?php echo ($material->getDisplay())?'':'(Oculto)'?>
      </td>
    </tr>
  <?php endfor; ?>
  <tr>
    <td><ul><li></li><ul></td>
    <td colspan="6"><?php echo m_link_to('nuevo...', 'materials/create?mm='.$mm, array('title' => 'Crear Material'), array('width' => '800')) ?></td>
  </tr>
</tbody></table>

