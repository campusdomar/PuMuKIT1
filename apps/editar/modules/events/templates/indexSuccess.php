<h3 class="cab_body_div">
  Retransmisiones en Directo
</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_event" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('events', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_events" name="list_events" act="/events/list">
      <?php include_component('events', $div) ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <li><?php echo button_to_function('Nueva Serie', 'Modalbox.show("'.url_for('events/createseveral'.$div_url).'", {title:"Crear serie de Eventos Nuevos", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
        <li><?php echo button_to_function('Nuevo Evento', 'Modalbox.show("'.url_for('events/create'.$div_url).'", {title:"Crear Nuevo Evento", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_events" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('event', $('options_events'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <!-- <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
      <option value="inv_working_sel">Ocultar/Desocultar selecionados</option> 
      <option value="inv_working_all">Ocultar/Desocultar todos</option> -->
    </select>
    
  </div>
</div>