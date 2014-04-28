<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('mattype', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th width="5%"><?php echo __('Type')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('MIME type')?></th>
      <th width="5%"><?php echo __('Materiales')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($mattypes) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen tipos de materiales con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($mattypes as $mattype): $odd = fmod(++$i, 2); $numM = $mattype->countMaterials()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($mattype->getId() == $sf_user->getAttribute('id', null, 'tv_admin/mattype')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $mattype->getId()?>" class="mattype_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'mattypes/edit?id=' . $mattype->getId(), array('title' => __('Editar tipo de material "').$mattype->getName() . '"'), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_mattypes', 'url' => 'mattypes/delete?id='.$mattype->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar este material?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_mattypes', 'url' => 'mattypes/copy?id='.$mattype->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_mattype" title="<?php echo __('Seleccionar este tipo de material por defecto')?>"
               value="mattype_<?php echo $mattype->getId()?>" 
               <?php echo $mattype->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/mattypes/default/id/<?php echo $mattype->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo $mattype->getId() ?>
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo $mattype->getType(); ?>
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo $mattype->getName(); ?>
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo $mattype->getMimeType(); ?>
      </td>
      <td onclick="click_fila('mattype', this, <?php echo $mattype->getId() ?>);">
        <?php echo $numM?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'mattype', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_mattype ?>/<?php echo $total_mattype_all ?> <?php echo __('Tipos')?>
        <?php $aux = ($total_mattype==$total_mattype_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar búsqueda', array('before' => '$("filter_mattypes").reset();', 'update' => 'list_mattypes', 'url' => 'mattypes/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>