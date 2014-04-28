<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('user', this.checked)">
      </th>
      <th colspan="2" width="3%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Nombre')?></th>
      <th><?php echo __('Login')?></th>
      <th><?php echo __('Tipo')?></th>
      <th><?php echo __('Email')?></th>
      <th width="1%"><?php echo __('Root')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($users) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen usuarios con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('users') as $user): $odd = fmod(++$i, 2)?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($user->getId() == $sf_user->getAttribute('id', null, 'tv_admin/user')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $user->getId()?>" class="user_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'users/edit?id=' . $user->getId(), array('title' => __('Editar Usuario').' "'.$user->getName() .'"'), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt='  .__('borrar') . ' title=' . __('borrar')), array('update' => 'list_users', 'url' => 'users/delete?id='.$user->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar el usuario').' "' . $user->getName() . '"?'))?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php echo $user->getId() ?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php $value = $user->getName(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php $value = $user->getLogin(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php $aux = array(0 => "Administrador",1 => "Publicador",2 => "FTP"); echo $aux[$user->getUserTypeId()] ?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php $value = $user->getEmail(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila_np('user', this, <?php echo $user->getId() ?>);">
        <?php $value = $user->getRoot(); echo $value ? $value : '&nbsp;'  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="9">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'user', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_user ?>/<?php echo $total_user_all ?> <?php echo __('Usuarios')?>
        <?php $aux = ($total_user == $total_user_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_users").reset();', 'update' => 'list_users', 'url' => 'users/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>

<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>