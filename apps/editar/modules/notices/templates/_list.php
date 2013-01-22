<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('notice', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <th width="1%">Id</th>
      <th width="7%">Fecha</th>
      <th width="1%">Oculto</th>
      <th>Texto</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($notices) == 0):?>
    <tr>
      <td colspan="8">
       No existen noticias con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('notices') as $notice): $odd = fmod(++$i, 2)?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($notice->getId() == $sf_user->getAttribute('id', null, 'tv_admin/notice')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $notice->getId()?>" class="notice_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('notice', this, <?php echo $notice->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'notices/edit?id=' . $notice->getId(), array('title' => 'Editar Novedad '.$notice->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_notices', 'url' => 'notices/delete?id='.$notice->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar la noticia de fecha ' . $notice->getDate('d/m/Y'). '?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_notices', 'url' => 'notices/copy?id='.$notice->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila('notice', this, <?php echo $notice->getId() ?>);">
        <?php echo $notice->getId() ?>
      </td>
      <td onclick="click_fila('notice', this, <?php echo $notice->getId() ?>);">
        <?php echo $notice->getDate('d/m/Y'); ?>
      </td>
      <td onclick="click_fila('notice', this, <?php echo $notice->getId() ?>);">
        <?php $value = $notice->getWorking(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('notice', this, <?php echo $notice->getId() ?>);">
        <?php $value = $notice->getText(); echo $value ? $value : '&nbsp;'  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="8">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'notice', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_notice ?>/<?php echo $total_notice_all ?> Noticias
        <?php $aux = ($total_notice==$total_notice_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar busqueda', array('before' => '$("filter_notices").reset();', 'update' => 'list_notices', 'url' => 'notices/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>