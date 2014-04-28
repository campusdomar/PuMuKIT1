<h3 class="cab_body_div">
 <!--<button onclick="location.href='<?php echo url_for('transcoders/index') ?>'" class="btn_view_tr" type="button">
    <span class="span_view_tr">
      <?php echo __('Vista Cl&aacute;sica')?>
    </span>
  </button>
 <button onclick="location.href='<?php echo url_for('transcoders/index') ?>'" class="btn_view_tr" type="button">
    <span class="span_view_tr">
      <?php echo __('Vista Moderna')?>
    </span>
  </button>-->

  <img src="/images/admin/cab/process.png"/> <?php echo __('Lista de tareas de transcodificación.')?>
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
          evalScripts:true, method: 'post', frequency: 8, decay: 1
        });
") ?>


    <!--
    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <li><?php echo button_to_function('Trans. directorio', 'Modalbox.show("transcoders/create", {title:"' . __('Transcodificar directorio') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>
    -->

    <select id="options_transcoder" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('transcoder', $('options_transcoder'))">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="disabled">---</option>
        
        <option value="transc_pause"><?php echo __('Pausar v&iacute;deos en espera seleccionados')?></option>
        <option value="transc_play"><?php echo __('Reanudar v&iacute;deos pausados seleccionados')?></option>
        
        <option disabled="disabled">---</option>
        <option value="transc_borrar"><?php echo __('Borrar v&iacute;deos seleccionados')?></option>
        <option value="transc_limpiar"><?php echo __('Limpiar de la tabla v&iacute;deos seleccionados completados')?></option>
    </select>

  </div>    
</div>

