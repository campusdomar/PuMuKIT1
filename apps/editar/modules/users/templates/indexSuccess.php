<h3 class="cab_body_div"><img src="/images/admin/cab/user_ico.png"/> Usuarios</h3>


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
        <li><?php echo button_to_function('create', 'Modalbox.show("users/create", {title:"Editar Nueva Usuario", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_users" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('user', $('options_users'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
    </select>
    
  </div>
</div>