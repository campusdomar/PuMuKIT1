<h3 class="cab_body_div"><img src="/images/admin/cab/widget_ico.png"/> 
  <a href="<?php echo url_for('widgets/index')?>"  style="color: #666E73; font-size: 75%">[ WebTV Layout ]</a> <?php echo __('News')?>
</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_notice" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('notices', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div id="list_notices" name="list_notices" act="/notices/list">
      <?php include_component('notices', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function(__('create'), 'Modalbox.show("notices/create", {title:"' . __('Editar Nueva Noticia') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_notices" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('notice', $('options_notices'))">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="">---</option>
      <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
      <option value="create"><?php echo __('Crear nuevo')?></option>
      <option value="inv_working_sel"><?php echo __('Ocultar/Mostrar seleccionados')?></option> 
      <option value="inv_working_all"><?php echo __('Ocultar/Mostrar todos')?></option> 
    </select>
    
  </div>
</div>