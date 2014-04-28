<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('resolution', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Ver')?></th>
      <th><?php echo __('Hor')?></th>
      <th><?php echo __('Files')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($resolutions) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen noticias con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($resolutions as $resolution): $odd = fmod(++$i, 2); $numF = $resolution->countFiles()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($resolution->getId() == $sf_user->getAttribute('id', null, 'tv_admin/resolution')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $resolution->getId()?>" class="resolution_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('resolution', this, <?php echo $resolution->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'resolutions/edit?id=' . $resolution->getId(), array('title' => __('Editar Novedad ').$resolution->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_resolutions', 'url' => 'resolutions/delete?id='.$resolution->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_resolutions', 'url' => 'resolutions/copy?id='.$resolution->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_resolution" title="<?php echo __('Seleccionar esta resolución por defecto')?>"
               value="resolution_<?php echo $resolution->getId()?>" 
               <?php echo $resolution->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/resolutions/default/id/<?php echo $resolution->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('resolution', this, <?php echo $resolution->getId() ?>);">
        <?php echo $resolution->getId() ?>
      </td>
      <td onclick="click_fila('resolution', this, <?php echo $resolution->getId() ?>);">
        <?php echo $resolution->getHor(); ?>
      </td>
      <td onclick="click_fila('resolution', this, <?php echo $resolution->getId() ?>);">
        <?php echo $resolution->getVer(); ?>
      </td>
      <td onclick="click_fila('resolution', this, <?php echo $resolution->getId() ?>);">
        <?php echo $numF?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'resolution', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_resolution ?>/<?php echo $total_resolution_all ?> <?php echo __('Resolution')?>
      </th>
    </tr>
  </tfoot>
</table>
