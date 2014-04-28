<h3 class="cab_body_div">
 <button onclick="location.href='<?php echo url_for('serials/index') ?>'" class="btn_atras_mms" type="button">
    <span class="span_atras_mms">
      <?php echo __('Volver a la serie')?>
    </span>
  </button>

  <img src="/images/admin/cab/serial_ico.png"/> <?php echo __('Objetos multimedia')?>
  <span style="font-size:72%">(<?php echo ($serial->getId())?>-<?php echo ($serial->getTitle());?>)</span>
  <input type="hidden" name="serial_id" id="mms_serial_id" value="<?php echo ($serial->getId())?>" />
</h3>


<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <div id="preview_mm" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; margin-bottom: 10px">
      <?php include_component('mms', 'preview') ?>
      
    </div>
  </div>



  <div id="tv_admin_content" >
    <div id="list_mms" name="list_mms" act="/mms/list" style="min-width: 690px;">
      <?php include_component('mms', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li>
         <?php echo link_to_function(__('Wizard'), "Modalbox.show('".url_for("wizard/mm?id=".$serial->getId())."',{width: 800, title:'" . __('PASO II: OBJ.MM.') . "'})", 'class=tv_admin_action_next') ?> 
        </li>
        <li>
          <?php echo link_to_remote(__('Crear'), array('update' => 'list_mms', 'url' => 'mms/create?filter=filter&page=last', 'script' => 'true'), array('title' => __('Crear nueva serie'), 'class' => 'tv_admin_action_create')) ?>
        </li>
      </ul>
    </div>

    <select id="options_mms" style="margin: 10px 0px; width: 33%; float: left" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('mm', $('options_mms'))">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="">---</option>

      <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
      <option value="inv_announce_sel"><?php echo __('Anunciar/Desanunciar seleccionados')?></option>
      <option disabled="">---</option>
      <option disabled=""value="set_status_0_sel"><?php echo __('Bloquear seleccionados')?></option> 
      <option disabled=""value="set_status_1_sel"><?php echo __('Ocultar seleccionados')?></option> 
      <option disabled=""value="set_status_2_sel"><?php echo __('Publicar seleccionados')?></option> 
      <option disabled=""value="set_status_3_sel"><?php echo __('Publicar totalmente seleccionados')?></option>
      <option disabled="">---</option>
      <option value="set_order_pub_des"><?php echo __('Ordenar objetos multimedia por fecha de publicación de forma descendente')?></option> 
      <option value="set_order_pub_asc"><?php echo __('Ordenar objetos multimedia por fecha de publicación de forma ascendente')?></option> 
      <option value="set_order_rec_des"><?php echo __('Ordenar objetos multimedia por fecha de grabación de forma descendente')?></option> 
      <option value="set_order_rec_asc"><?php echo __('Ordenar objetos multimedia por fecha de grabación de forma ascendente')?></option> 
      <option disabled="">---</option>
      <option value="cut_mm"><?php echo __('Cortar objetos multimedia')?></option> 
      <?php if($sf_user->hasAttribute('cut_mms')): ?>
        <option value="paste_mm">
          <?php echo __('Pegar objetos multimedia')?> (<?php echo implode(',', $sf_user->getAttribute('cut_mms')->getRawValue())?>)
        </option>
      <?php endif ?>
      <option disabled="">---</option>
      <option value="serial_preview"><?php echo __('Vista Previa de la serie')?></option> 
      <!-- <option value="serial_master"><?php echo __('Crear obj. mm. con brutos de cámara')?></option>  -->
    </select>
    
  </div>
  <div style="clear:both"></div>
</div>


</div>

<!-- div editar -->
<div id="edit_mms" class="tv_admin_edit" >  
      <?php include_component('mms', 'edit')?>




<?php echo javascript_tag("
var update_file;
window.onload = function(){
  Shadowbox.init({
    skipSetup:  true,
    onOpen:     function(element) {
                  if (typeof update_file == 'object') update_file.stop();
                },
    onClose:    function(element) {
                  if (typeof update_file == 'object') update_file.start();
                }
  });
};
window.update_preview = function(id) {
  new Ajax.Updater('preview_mm', '" . url_for("mms/preview") . "/id/' + id, {asynchronous:true, evalScripts:true});
}
") ?>
