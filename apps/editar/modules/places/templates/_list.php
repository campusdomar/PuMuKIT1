<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('place', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <?php include_partial('list_th')?>
      <th width="1%">Precintos</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($places) == 0):?>
  <tr>
      <td colspan="10">
       No existen lugares con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('places') as $place): $odd = fmod(++$i, 2); $numV = $place->countPrecincts()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($place->getId() == $sf_user->getAttribute('id', null, 'tv_admin/place')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $place->getId()?>" class="place_checkbox" type="checkbox">
      </td>
      <td>
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'places/edit?id=' . $place->getId(), array('title' => 'Editar Lugar '.$place->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_places', 'url' => 'places/delete?id='.$place->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar este lugar?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_places', 'url' => 'places/copy?id='.$place->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila_place( this, <?php echo $place->getId() ?>);">
        <div class="flecha"></div> 
        <?php echo $place->getId() ?>
      </td>
      <td onclick="click_fila_place( this, <?php echo $place->getId() ?>);">
        <?php $value = $place->getName(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_place( this, <?php echo $place->getId() ?>);">
        <?php $value = $place->getAddress(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_place( this, <?php echo $place->getId() ?>);">
        <?php echo $numV  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'place', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_place ?>/<?php echo $total_place_all ?> Lugares
        <?php $aux = ($total_place==$total_place_all?'display:none; ':'')?>
        <?php echo link_to_remote('X', array('before' => '$("filter_places").reset();', 'update' => 'list_places', 'url' => 'places/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>
  

<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
