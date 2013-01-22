<h3 class="cab_body_div"><img src="/images/admin/cab/config_ico.png"/> Formats</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
<?php include_partial('filters') ?>
    <div id="preview_format" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php //include_component('formats', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_formats" name="list_formats" act="/formats/list">
      <?php include_component('formats', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function('create', 'Modalbox.show("formats/create", {title:"Editar Nuevo Rol", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_formats" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('format', $('options_formats'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
    </select>
    
  </div>
</div>