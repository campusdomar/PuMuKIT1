<h3 class="cab_body_div">
 <button onclick="location.href='<?php echo url_for('serials/index') ?>'" class="btn_atras_mms" type="button">
    <span class="span_atras_mms">
      Volver a la serie
    </span>
  </button>

  <img src="/images/admin/cab/serial_ico.png"/> Objetos multimedia
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
          <?php echo link_to_function('Wizard', "Modalbox.show('".url_for("mmwizard/index?mod=mms&serial_id=".$serial->getId())."',{width: 800, title:'PASO I'})", 'class=tv_admin_action_next') ?> 
        </li>
        <li>
          <?php echo link_to_remote('Crear', array('update' => 'list_mms', 'url' => 'mms/create?filter=filter&page=last', 'script' => 'true'), array('title' => 'Crear nueva serie', 'class' => 'tv_admin_action_create')) ?>
        </li>
      </ul>
    </div>

    <select id="options_mms" style="margin: 10px 0px; width: 33%; float: left;" title="Acciones sobre elementos selecionados" onchange="window.change_select('mm', $('options_mms'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>

      <option value="delete_sel">Borrar selecionados</option>
      <option value="inv_announce_sel">Anunciar/Desanunciar selecionados</option>
      <option disabled="">---</option>
      <option disabled=""value="set_status_0_sel">Bloquear selecionados</option> 
      <option disabled=""value="set_status_1_sel">Ocultar selecionados</option> 
      <option disabled=""value="set_status_2_sel">Publicar selecionados</option> 
      <option disabled=""value="set_status_3_sel">Publicar totalmente selecionados</option>
      <option disabled="">---</option>
      <option value="set_order_pub_des">Ordenar objetos multimedia por fecha de publicacion de forma descendiente</option> 
      <option value="set_order_pub_asc">Ordenar objetos multimedia por fecha de publicacion de forma ascendiente</option> 
      <option value="set_order_rec_des">Ordenar objetos multimedia por fecha de grabacion de forma descendiente</option> 
      <option value="set_order_rec_asc">Ordenar objetos multimedia por fecha de grabacion de forma ascenditente</option> 
      <option disabled="">---</option>
      <option value="cut_mm">Cortar objetos multimedia</option> 
      <?php if($sf_user->hasAttribute('cut_mms')): ?>
        <option value="paste_mm">
          Pegar objetos multimedia (<?php echo implode(',', $sf_user->getAttribute('cut_mms')->getRawValue())?>)
        </option>
      <?php endif ?>
      <option disabled="">---</option>
      <option value="serial_preview">Vista Previa de la serie</option> 
      <!-- <option value="serial_master">Crear obj. mm. con brutos de camara</option>  -->
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
