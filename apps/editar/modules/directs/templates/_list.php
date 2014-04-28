<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('direct', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Nombre')?></th>
      <th><?php echo __('URL')?></th>
      <th width="1%"><?php echo __('Resoluci&oacute;n')?></th>
      <th width="8%"><?php echo __('Type')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($directs) == 0):?>
    <tr class="tv_admin_row_1">
      <td colspan="9" >
       <?php echo __('No existen canales en directo con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('directs') as $direct): $odd = fmod(++$i, 2)?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($direct->getId() == $sf_user->getAttribute('id', null, 'tv_admin/direct')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $direct->getId()?>" class="direct_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'directs/edit?id=' . $direct->getId(), array('title' => __('Editar canal en directo ').$direct->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_directs', 'url' => 'directs/delete?id='.$direct->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea eliminar este canal?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_directs', 'url' => 'directs/copy?id='.$direct->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php echo $direct->getId() ?>
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php $value = $direct->getName(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php $value = $direct->getUrl(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php $value = $direct->getResolution(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('direct', this, <?php echo $direct->getId() ?>);">
        <?php $value = $direct->getDirectType(); echo $value ? $value : '&nbsp;'  ?>
      </td>
    </tr>
  <?php endforeach; ?>

  </tbody>
  <tfoot>
    <tr>
      <th colspan="9">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'direct', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_direct ?>/<?php echo $total_direct_all ?> <?php echo __('Canales')?>
        <?php $aux = ($total_direct == $total_direct_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_directs").reset();', 'update' => 'list_directs', 'url' => 'directs/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>

<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>