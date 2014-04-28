<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('format', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Files')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($formats) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen noticias con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($formats as $format): $odd = fmod(++$i, 2); $numF = $format->countFiles()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($format->getId() == $sf_user->getAttribute('id', null, 'tv_admin/format')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $format->getId()?>" class="format_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('format', this, <?php echo $format->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'formats/edit?id=' . $format->getId(), array('title' => __('Editar Novedad ').$format->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_formats', 'url' => 'formats/delete?id='.$format->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_formats', 'url' => 'formats/copy?id='.$format->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_format" title="<?php echo __('Seleccionar este formato por defecto')?>"
               value="format_<?php echo $format->getId()?>" 
               <?php echo $format->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/formats/default/id/<?php echo $format->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('format', this, <?php echo $format->getId() ?>);">
        <?php echo $format->getId() ?>
      </td>
      <td onclick="click_fila('format', this, <?php echo $format->getId() ?>);">
        <?php echo $format->getName(); ?>
      </td>
      <td onclick="click_fila('format', this, <?php echo $format->getId() ?>);">
        <?php echo $numF?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'format', 'page' => $page, 'total' => $total)) ?>
        </div>
        <?php echo $total_format ?>/<?php echo $total_format_all ?> <?php echo __('Format')?>
      </th>
    </tr>
  </tfoot>
</table>
