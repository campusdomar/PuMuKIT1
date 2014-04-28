<h3 class="cab_body_div"><img src="/images/admin/cab/direct_ico.png"/> <?php echo __('Canales en directo')?></h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_direct" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; text-align:center">
      <?php include_component('directs', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_directs" name="list_directs" act="/directs/list">
      <?php include_component('directs', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function(__('nuevo'), 'Modalbox.show("directs/create", {title:"' . __('Editar Nuevo Directo') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_directs" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('direct', $('options_directs'))">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="">---</option>
      <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
      <option value="create"><?php echo __('Crear nuevo')?></option>
    </select>
    
  </div>
</div>


<?php echo javascript_tag("
Shadowbox.init({
        skipSetup: true 
    });
") ?>
