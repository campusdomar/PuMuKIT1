<h3 class="cab_body_div"> Cpus para transco.</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <div id="preview_cpu" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('cpus', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_cpus" name="list_cpus" act="/cpus/list">
      <?php include_component('cpus', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function('create', 'Modalbox.show("cpus/create", {title:"Editar Nuevo Rol", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>


    <select id="options_cpus" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('cpu', $('options_cpus'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
    </select>

  </div>    
</div>
