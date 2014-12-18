<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="14%">LUNES</th>
      <th width="14%">MARTES</th>
      <th width="14%">MIERCOLES</th>
      <th width="14%">JUEVES</th>
      <th width="14%">VIERNES</th>
      <th width="14%">SABADO</th>
      <th width="14%">DOMINGO</th>
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
                    <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_events', 'url' => 'events/delete?cal=cal&id='.$e->getId(), 'script' => 'true', 'confirm' => 'Seguro que desea borrar el evento de fecha ' . $e->getDate('d/m/Y H:m'). '?'))?>
                    <?php echo m_link_to($e->getName(), 'events/edit?cal=cal&id=' . $e->getId(), array('title' => 'Editar Novedad '.$e->getId()), array('width' => '800')) ?>
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
          <a class="azul" href="<?php echo url_for('events/index')?>" style="color:blue">Lista</a>
          <a class="azul" href="<?php echo url_for('events/index?cal=cal')?>" style="color:grey">Calendario</a>
        </div>
        <div class="float-right">
          <?php echo link_to_remote('&laquo;Anterior', array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=menos', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
          &nbsp;<?php echo $m.'-'.$y?>&nbsp;
          <?php echo link_to_remote('HOY', array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=hoy', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
          <?php echo link_to_remote('Siguiente&raquo;', array('update'=> 'list_events', 'url' => 'events/list?cal=cal&mes=mas', 'script' => 'true'), array('class' =>'azul', 'style' => 'color:blue')) ?>
        </div>
        <?php echo $total_event ?>/<?php echo $total_event_all ?> Eventos
      </th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>