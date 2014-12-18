<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('streamserv', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <th width="1%">Id</th>
      <th>Tipo</th>
      <th>Nombre</th>
      <th>IP</th>
      <th>PATH OUT</th>
      <th>Url OUT</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($streamservs) == 0):?>
    <tr>
      <td colspan="10">
       No existen servidores de streaming con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($streamservs as $streamserv): $odd = fmod(++$i, 2);?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($streamserv->getId() == $sf_user->getAttribute('id', null, 'tv_admin/streamserv')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $streamserv->getId()?>" class="streamserv_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'streamservs/edit?id=' . $streamserv->getId(), array('title' => 'Editar Servidor '.$streamserv->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_streamservs', 'url' => 'streamservs/delete?id='.$streamserv->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro? (No se pude si tiene perfiles asociados)'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_streamservs', 'url' => 'streamservs/copy?id='.$streamserv->getId(), 'script' => 'true'))?>
      </td>
      
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getId() ?>
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getStreamserverType()->getName() ?>
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getName(); ?>
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getIp()?>
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getDirOut(); ?>
      </td>
      <td onclick="click_fila('streamserv', this, <?php echo $streamserv->getId() ?>);">
        <?php echo $streamserv->getUrlOut(); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'streamserv', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_streamserv ?>/<?php echo $total_streamserv_all ?> streamserv
      </th>
    </tr>
  </tfoot>
</table>
