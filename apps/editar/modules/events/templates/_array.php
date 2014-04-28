<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('event', this.checked)">
      </th>
      <th colspan="2" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th width="7%"><?php echo __('Fecha')?></th>
      <th><?php echo __('Texto')?></th>
      <th width="1%"><?php echo __('P&uacute;blico')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($events) == 0):?>
    <tr>
      <td colspan="7">
       <?php echo __('No existen eventos con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('events') as $event): $odd = fmod(++$i, 2)?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($event->getId() == $sf_user->getAttribute('id', null, 'tv_admin/event')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $event->getId()?>" class="event_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('event', this, <?php echo $event->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'events/edit?id=' . $event->getId(), array('title' => __('Editar Novedad ').$event->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_events', 'url' => 'events/delete?id='.$event->getId(), 'script' => 'true', 'confirm' => __('¿Seguro que desea borrar el evento de fecha ') . $event->getDate('d/m/Y H:m'). '?'))?>
      </td>
      <td onclick="click_fila('event', this, <?php echo $event->getId() ?>);">
        <?php echo $event->getId() ?>
      </td>
      <td onclick="click_fila('event', this, <?php echo $event->getId() ?>);">
        <?php echo $event->getDate('d/m/Y-H:m'); ?>
      </td>
      <td onclick="click_fila('event', this, <?php echo $event->getId() ?>);">
        <?php $value = $event->getName(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('event', this, <?php echo $event->getId() ?>);">
        <?php $value = $event->getDisplay(); echo $value ? $value : '&nbsp;'  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="7">        
        <div class="float-left" style="padding-right: 5px">
          <a class="azul" title="<?php echo __('Lista')?>" href="<?php echo url_for('events/index')?>" style="color:grey"><?php echo __('Lista')?></a>
          <a class="azul" title="<?php echo __('Calendario')?>" href="<?php echo url_for('events/index?cal=cal')?>" style="color:blue"><?php echo __('Calendario')?></a>
        </div>
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'event', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_event ?>/<?php echo $total_event_all ?> <?php echo __('Eventos')?>
        <?php $aux = ($total_event==$total_event_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_events").reset();', 'update' => 'list_events', 'url' => 'events/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>