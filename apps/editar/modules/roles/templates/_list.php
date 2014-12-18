<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('role', this.checked)">
      </th>
      <th colspan="5" width="7%"></th>
      <th width="1%">Id</th>
      <th width="1%">Display</th>
      <th>Codigo</th>
      <th>Name</th>
      <th width="1%">Roles</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($roles) == 0):?>
      <tr>
        <td colspan="11">
         No existen roles con esos valores.
        </td>
      </tr>
    <?php endif; ?>
    <?php $t = count($roles) ; for( $i=0; $i<$t; $i++): $role = $roles[$i]; $odd = fmod($i, 2); $numP = $role->countMmPersons()?>
      <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($role->getId() == $sf_user->getAttribute('id', null, 'tv_admin/role')) echo ' tv_admin_row_this'?>" >
        <td>
          <input id="<?php echo $role->getId()?>" class="role_checkbox" type="checkbox">
        </td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'roles/edit?id=' . $role->getId(), array('title' => 'Editar Novedad '.$role->getId()), array('width' => '800')) ?>
        </td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php 
  if ($numP ==0 ){
    echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_roles', 'url' => 'roles/delete?id='.$role->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro?'));
  }else{
    echo link_to_function(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), "alert('Imposible borrar, con ". $numP ." persons ')");  
  }
     ?>
        </td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_roles', 'url' => 'roles/copy?id='.$role->getId(), 'script' => 'true'))?>
        </td>
	<td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo ((($page == 1)&&( $i == 0)) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'list_roles', 'url' => 'roles/up?id='.$role->getId(), 'script' => 'true'))).(link_to_remote('&#8657;', array('update' => 'list_roles', 'url' => 'roles/top?id='.$role->getId(), 'script' => 'true'))))   ?>
        </td>
	<td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo ((($page == $total)&&( $i == $t-1))? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'list_roles', 'url' => 'roles/down?id='.$role->getId(), 'script' => 'true'))).(link_to_remote('&#8659;', array('update' => 'list_roles', 'url' => 'roles/bottom?id='.$role->getId(), 'script' => 'true')))) ?>
        </td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo $role->getId() ?>
	</td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
          <?php echo $role->getDisplay() ?>
	</td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
	  <?php echo $role->getCod() ?>
	</td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
	  <?php echo $role->getName() ?>
	</td>
        <td onclick="click_fila('role', this, <?php echo $role->getId() ?>);">
	  <?php echo $numP ?>
	</td>
      </tr>
    <?php endfor; ?>
  </tbody>
  <tfoot>
    <tr>
  <th colspan="11">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'role', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_role ?>/<?php echo $total_role_all ?> Roles
        <?php $aux = ($total_role==$total_role_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar busqueda', array('before' => '$("filter_roles").reset();', 'update' => 'list_roles', 'url' => 'roles/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>