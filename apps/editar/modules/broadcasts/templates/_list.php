<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('broadcast', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th width="5%"><?php echo __('Type')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Description')?></th>
      <th><?php echo __('Serials')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($broadcasts) == 0):?>
    <tr>
      <td colspan="10">
       <?php echo __('No existen difusiones con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($broadcasts as $broadcast): $odd = fmod(++$i, 2); $numS = $broadcast->countMms()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($broadcast->getId() == $sf_user->getAttribute('id', null, 'tv_admin/broadcast')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $broadcast->getId()?>" class="broadcast_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'broadcasts/edit?id=' . $broadcast->getId(), array('title' => __('Editar Difusión ').$broadcast->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_broadcasts', 'url' => 'broadcasts/delete?id='.$broadcast->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar esta difusión?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_broadcasts', 'url' => 'broadcasts/copy?id='.$broadcast->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_broadcast" title="<?php echo __('Seleccionar esta difusión por defecto')?>"
               value="broadcast_<?php echo $broadcast->getId()?>" 
               <?php echo $broadcast->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/broadcasts/default/id/<?php echo $broadcast->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php echo $broadcast->getId() ?>
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php echo $broadcast->getBroadcastType()->getName(); ?>
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php echo $broadcast->getName(); ?>
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php $value = $broadcast->getDescription(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('broadcast', this, <?php echo $broadcast->getId() ?>);">
        <?php echo $numS?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'broadcast', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_broadcast ?>/<?php echo $total_broadcast_all ?> <?php echo __('Difusiones')?>
        <?php $aux = ($total_broadcast==$total_broadcast_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar búsqueda', array('before' => '$("filter_broadcasts").reset();', 'update' => 'list_broadcasts', 'url' => 'broadcasts/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>