<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('serial', this.checked)">
      </th>
      <th colspan="5" width="5%"></th>
      <?php if(sfConfig::get('app_mail_use')):?>
      <th width="2%"></th>
      <?php endif?>
      <th width="1%"><?php echo __('Img')?></th>
      <?php include_partial('list_th') ?>
    </tr>
  </thead>

  <tbody>
  <?php if (count($serials) == 0):?>
    <tr>
      <td colspan="13">
       <?php echo __('No existen series con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($serials as $serial): $odd = fmod(++$i, 2); $numV = $serial['mm_count'] ?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?> <?php if($serial['id'] == $sf_user->getAttribute('id', null, 'tv_admin/serial')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $serial['id']?>" class="serial_checkbox" type="checkbox">
      </td>
      <td style="width:12px">
        <?php echo ($serial['announce']?'<span style="color: blue">A</span>':'') ?>
        <?php echo ($serial['mm_announce']?'<span style="color: grey">A</span>':'') ?>
        <?php echo (($serial['mm_announce'])||($serial['announce'])?'':'&nbsp;') ?>
      </td> 
      <td style="width:12px">
          <?php echo image_tag('admin/bbuttons/mm'.$serial['mm_status_max'].'_inline.gif', array('alt' => __('estado'), 'title'=>__('estado'), 'id'=>'table_serials_status_' . $serial['id'])) ?>
      </td> 
      <td  style="width:12px">
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar') . ' class=miniTag'), array('update' => 'list_serials', 'url' => 'serials/delete?id='.$serial['id'], 'script' => 'true', 'confirm' => __('Seguro que desea borrar la serie "') . $serial['title'] . '", ' . __('tiene ') .$numV.__(' objetos multimedia'), 'success' => '$("vista_previa_serial").innerHTML="<h2>select serial</h2>";$("edit_serials").innerHTML="<h2>select serial</h2>"; ')); ?>
      </td>
      <td style="width:12px">              
        <?php include_partial("serials/edit_menu", array('serial' => $serial, 'numV' => $numV))?>
      </td>
      <?php if(sfConfig::get('app_mail_use')):?>
      <td style="width:12px">              
        <?php include_partial("serials/edit_announce", array('serial' => $serial))?>
      </td>
      <?php endif ?>
      <td>
        <?php echo link_to('videos', 'mms/index?serial=' . $serial['id'])?>
      </td>
      <td onclick="click_fila_edit('serial', this, <?php echo $serial['id'] ?>)" ondblclick="dblclick_fila('serial', this, <?php echo $serial['id'] ?>)">
        <?php echo image_tag($serial['pic_url'], 'class=mini size=23x23')?>
      </td>
      <td onclick="click_fila_edit('serial', this, <?php echo $serial['id'] ?>)" ondblclick="dblclick_fila('serial', this, <?php echo $serial['id'] ?>)">
        <span style="font-weight: bold; "><?php echo $serial['id']?></span>
      </td>
      <td onclick="click_fila_edit('serial', this, <?php echo $serial['id'] ?>)" ondblclick="dblclick_fila('serial', this, <?php echo $serial['id'] ?>)">
        <?php $value = $serial['title']; echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_edit('serial', this, <?php echo $serial['id'] ?>)" ondblclick="dblclick_fila('serial', this, <?php echo $serial['id'] ?>)">
        <?php $value = $serial['publicdate']; echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_edit('serial', this, <?php echo $serial['id'] ?>)" ondblclick="dblclick_fila('serial', this, <?php echo $serial['id'] ?>)">
        <?php echo $numV ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="13">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'serial', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_serial ?>/<?php echo $total_serial_all ?> <?php echo __('Series')?>
        <?php $aux = ($total_serial==$total_serial_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_serials").reset();', 'update' => 'list_serials', 'url' => 'serials/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
