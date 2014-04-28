<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="14%"><?php echo __('LUNES')?></th>
      <th width="14%"><?php echo __('MARTES')?></th>
      <th width="14%"><?php echo __('MIÉRCOLES')?></th>
      <th width="14%"><?php echo __('JUEVES')?></th>
      <th width="14%"><?php echo __('VIERNES')?></th>
      <th width="14%"><?php echo __('SÁBADO')?></th>
      <th width="14%"><?php echo __('DOMINGO')?></th>
    </tr>
  </thead>
  
  <tbody>

  <?php $total_event=0; foreach($cal as $dweek => $c):?>
    <tr>
    <?php foreach(range(0, 6) as $d):?>
      <td style="cursor: auto; <?php echo (date(dmY) == $cal[$dweek][$d].$m.$y)?"border:3px solid #000":""?>">
          <div style="overflow: hidden; position: relative; height: 70px;">
          <?php if(isset($cal[$dweek][$d])):?>
            <span style="position:absolute; top:0px; right:0px"><?php echo $cal[$dweek][$d]?></span>
             <?php $events = EventPeer::getByDate($y, $m, $cal[$dweek][$d])?>
             <ul style="padding-left: 6px; list-style-type: none; ">
               <?php foreach($events as $e): $total_event++?>
                 <li>
                    <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_events', 'url' => 'events/delete?cal=cal&id='.$e->getId(), 'script' => 'true', 'confirm' => __('¿Seguro que desea borrar el evento de fecha ') . $e->getDate('d/m/Y H:m'). '?'))?>
                    <?php echo m_link_to($e->getName(), 'events/edit?cal=cal&id=' . $e->getId(), array('title' => __('Editar Novedad ').$e->getId()), array('width' => '800')) ?>
                 </li>
               <?php endforeach?>
             </ul>
          <?php endif?>
        </div>
      </td>
    <?php endforeach?>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="7">        
        <div class="float-left" style="padding-right: 5px">
          <a class="azul" href="<?php echo url_for('events/index')?>" style="color:blue"><?php echo __('Lista')?></a>
          <a class="azul" href="<?php echo url_for('events/index?cal=cal')?>" style="color:grey"><?php echo __('Calendario')?></a>
        </div>
        <div class="float-right">
          <?php echo link_to_remote(__('&laquo;Anterior'), array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=menos', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
          &nbsp;<?php echo $m.'-'.$y?>&nbsp;
          <?php echo link_to_remote(__('HOY'), array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=hoy', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
          <?php echo link_to_remote(__('Siguiente&raquo;'), array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=mas', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
        </div>
        <?php echo $total_event ?>/<?php echo $total_event_all ?> <?php echo __('Eventos')?>
      </th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>