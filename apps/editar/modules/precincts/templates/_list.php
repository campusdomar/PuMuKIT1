<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('precinct', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th><?php echo __('Id')?></th>
      <th><?php echo __('Nombre')?></th>
      <th><?php echo __('Equipo')?></th>
      <th><?php echo __('Vídeos')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($precincts) == 0):?>
  <tr>
      <td colspan="10">
       <?php echo __('No existen recintos con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('precincts') as $precinct): $odd = fmod(++$i, 2); $numV = $precinct->countMms()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($precinct->getId() == $sf_user->getAttribute('id', null, 'tv_admin/precinct')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $precinct->getId()?>" class="precinct_checkbox" type="checkbox">
      </td>
      <td>
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'precincts/edit?id=' . $precinct->getId(), array('title' => __('Editar recinto ').$precinct->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_precincts', 'url' => 'precincts/delete?id='.$precinct->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_precincts', 'url' => 'precincts/copy?id='.$precinct->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_precinct" title="<?php echo __('Seleccionar este recinto por defecto')?>"
               value="precinct_<?php echo $precinct->getId()?>" 
               <?php echo $precinct->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/precincts/default/id/<?php echo $precinct->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('precinct', this, <?php echo $precinct->getId() ?>);">
        <?php echo $precinct->getId() ?>
      </td>
      <td onclick="click_fila('precinct', this, <?php echo $precinct->getId() ?>);">
        <?php $value = $precinct->getName(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('precinct', this, <?php echo $precinct->getId() ?>);">
        <?php $value = $precinct->getEquipment(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('precinct', this, <?php echo $precinct->getId() ?>);">
        <?php echo $numV  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div style="float:left; position: absolute;">
          <?php echo $total_precinct ?>R.
        </div>
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'precinct', 'page' => $page, 'total' => $total)) ?> 
        </div>
      </th>
    </tr>
  </tfoot>
</table>
  
<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
