<h3 class="cab_body_div"><img src="/images/admin/cab/user_ico.png"/> <?php echo __('Usuarios')?></h3>


<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
  </div>


  <div id="tv_admin_content" >
    <div id="list_users" name="list_users" act="/users/list">
      <?php include_component('users', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function(__('create'), 'Modalbox.show("users/create", {title:"' . __('Editar Nuevo Usuario') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_users" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('user', $('options_users'))">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="">---</option>
      <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
      <option value="create"><?php echo __('Crear nuevo')?></option>
    </select>
    
  </div>
</div>