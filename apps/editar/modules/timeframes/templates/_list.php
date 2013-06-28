<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('timeframe', this.checked)">
      </th>
      <th colspan="2" width="2%"></th>
      <?php // Cuando sea necesario hacer ordenables los títulos de las columnas, incluir esto: 
      //include_partial('list_th')?>
      <th width="1%">id</th>
      <th>category_id</th>
      <th>mm_id</th>
      <th>Comienzo</th>
      <th>Final</th>
      <th>Descripción</th>
      <th>Fecha de creación</th>
      <th>Fecha de actualización</th>
    </tr>
  </thead>
  <tbody>

    <?php if (count($timeframes) == 0):?>
      <tr>
        <td colspan="9">
         No existen timeframes con esos valores.
        </td>
      </tr>
    <?php endif; ?>
    <?php $t = count($timeframes) ; for( $i=0; $i<$t; $i++): $timeframe = $timeframes[$i]; $odd = fmod($i, 2); ?>
          <?php // CÓDIGO DE PERSONS $i = 1; foreach ($sf_data->getRaw('persons') as $person): $odd = fmod(++$i, 2); $numV = $person->countMmPersons()?>

      <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($timeframe->getId() == $sf_user->getAttribute('id', null, 'tv_admin/role')) echo ' tv_admin_row_this'?>" >
        <?php // checkbox individual ?>
        <td>
          <input id="<?php echo $timeframe->getId()?>" class="timeframe_checkbox" type="checkbox">
        </td>
        <?php // botón editar ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td>
          <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'timeframes/edit?id=' . $timeframe->getId(), array('title' => 'Editar timeframe '.$timeframe->getId() . ' '. $timeframe->getDescription()), array('width' => '800')) ?> </td>
        <?php // botón borrar ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td>
          <?php /*
            if ($numP ==0 ){
                echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_timeframes', 'url' => 'timeframes/delete?id='.$timeframe->getId(), 'script' => 'true', 'confirm' => 'Seguro'));
            }else{
                echo link_to_function(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), "alert('Imposible borrar, con ". $numP ." persons ')");  
              } */
            echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_timeframes', 'url' => 'timeframes/delete?id='.$timeframe->getId(), 'script' => 'true', 'confirm' => 'Seguro'));
            ?> </td>
        <?php // columna Id ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo $timeframe->getId() ?> </td>
        <?php // columna category_id ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getCategoryId() ?> </td>
        <?php // columna mm_id ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td>
          <?php echo $timeframe->getMmId() ?> </td>
        <?php // columna timestart ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getTimestart() ?> </td>
        <?php // columna timeend ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getTimeend(); ?> </td>
        <?php // columna description ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getDescription() ?> </td> 
        <?php // columna created_at ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getCreatedAt() ?> </td> 
        <?php // columna updated_at ?>
        <?php /* <td onclick="click_fila('timeframe', this, <?php echo $timefRame->getId() ?>);"> */?>
        <td><?php echo$timeframe->getUpdatedAt() ?> </td> 
      </tr>
    <?php endfor; ?>
  </tbody>
  <tfoot>
    <tr>
  <th colspan="11">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'timeframe', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_timeframe ?>/<?php echo $total_timeframe_all ?> timeframes
        <?php $aux = ($total_timeframe==$total_timeframe_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar busqueda', array('before' => '$("filter_timeframes").reset();', 'update' => 'list_timeframes', 'url' => 'timeframes/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>
<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
