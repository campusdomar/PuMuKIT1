<h3 class="cab_body_div"><img src="/images/admin/cab/config_ico.png"/> Tipos de series</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_serialtype" style="display:none; padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php //include_component('serialtypes', 'preview') ?>
    </div>
    <div style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('serialtypes', 'nube') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_serialtypes" name="list_serialtypes" act="/serialtypes/list">
      <?php include_component('serialtypes', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function('nuevo', 'Modalbox.show("serialtypes/create", {title:"Crear nuevo tipo de serie", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_serialtypes" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('serialtype', $('options_serialtypes'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
    </select>    

  </div>
</div>