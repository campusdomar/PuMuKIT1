<h3 class="cab_body_div"><img src="/images/admin/cab/serial_ico.png"/> Series Multimedia</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <div id="preview_serial" style="min-height:74px; padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; margin-bottom: 10px">
      <?php include_component('serials', 'preview') ?>
    </div>
    
    <?php include_partial('acordeon', array('name' => 'serial', 'broadcasts' => $broadcasts, 'serialtypes' => $serialtypes)) ?> 

  </div>



  <div id="tv_admin_content" >
    <div id="list_serials" name="list_serials" act="/serials/list">
      <?php include_component('serials', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li>
         <?php echo link_to_function('Wizard', "Modalbox.show('".url_for("wizard/serial")."',{width:800, title:'PASO I: Serie'})", 'class=tv_admin_action_next') ?> 
        </li>
        <li>
         <?php echo link_to_remote('Crear', array('before' => '$("filter_serials").reset();', 'update' => 'list_serials', 'url' => 'serials/create?filter=filter', 'script' => 'true'), array('title' => 'Crear nueva seria', 'class' => 'tv_admin_action_create')) ?>
        </li>
      </ul>
    </div>

    <select id="options_serials" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('serial', $('options_serials'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <!-- <option value="inv_announce_sel">Anunciar/Desanunciar selecionados</option> -->
      <!-- <option value="inv_working_sel">Ocultar/Desocultar selecionados</option> Ocultarlos todos -->
    </select>
    
  </div>
  <div style="clear:both"></div>
</div>


</div>

<!-- div editar -->
<div id="edit_serials" class="tv_admin_edit">  
  <?php include_component('serials', 'edit')?>


