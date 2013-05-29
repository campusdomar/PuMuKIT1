<h3 class="cab_body_div"><img src="/images/admin/cab/person_ico.png"/> Personas</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_person" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('persons', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_persons" name="list_persons" act="/persons/list">
      <?php include_component('persons', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li>
          <?php echo button_to_function('nuevo', 'Modalbox.show("persons/create", {title:"Editar Nueva Noticia", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?>
        </li>
      </ul>
    </div>

    <select id="options_persons" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('person', $('options_persons'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option>
      <option value="hono_person_sel">Separar honores de selecionados</option>
      <option value="hono_person_all">Separar honores de todos</option>
      <option value="merge_person_sel">Unificar varias personas</option>
    </select>
    
  </div>
</div>