<h3 class="cab_body_div">
 <!--<button onclick="location.href='<?php echo url_for('transcoders/index') ?>'" class="btn_view_tr" type="button">
    <span class="span_view_tr">
      Vista Cl&aacute;sica
    </span>
  </button>
 <button onclick="location.href='<?php echo url_for('transcoders/index') ?>'" class="btn_view_tr" type="button">
    <span class="span_view_tr">
      Vista Moderna
    </span>
  </button>-->

  <img src="/images/admin/cab/process.png"/> Lista de tareas de transcodificacion.
</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <div id="preview_transcoder" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('transcoders', 'preview') ?>
    </div>
    <br />
     <?php include_partial('acordeon', array('name' => 'transcoder')) ?> 
  </div>

  <div id="tv_admin_content" >
    <div id="list_transcoders" name="list_transcoders" act="/transcoders/list">
      <?php include_partial('transcoders/list') ?>
    </div>


<?php echo javascript_tag("
        update_file = new Ajax.PeriodicalUpdater('list_transcoders', '/editar.php/transcoders/list', {
          method: 'post', frequency: 8, decay: 1
        });
") ?>


    <!--
    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <li><?php echo button_to_function('Trans. directorio', 'Modalbox.show("transcoders/create", {title:"Transcodificar directorio", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>
    -->

    <select id="options_transcoder" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('transcoder', $('options_transcoder'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="disabled">---</option>
        
        <option value="transc_pause">Pausar V&iacute;deos en espera seleccionados</option>
        <option value="transc_play">Reanudar V&iacute;deos pausados seleccionados</option>
        
        <option disabled="disabled">---</option>
        <option value="transc_borrar">Borrar V&iacute;deos seleccionados</option>
        <option value="transc_limpiar">Limpiar de la tabla V&iacute;deos seleccionados completados</option>
    </select>

  </div>    
</div>

