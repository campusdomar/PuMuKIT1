<h3 class="cab_body_div"><img src="/images/admin/cab/place_ico.png"/> <?php echo __('Lugares &amp; Recintos')?></h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="preview_precinct" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%">
      <?php include_component('places', 'preview') ?>
    </div>
  </div>

  <div id="tv_admin_content" >
    <div style="width:55%; float:left;">
      <div id="list_places" name="list_places" act="/places/list" style="position:relative; padding-right: 20px; background:transparent url(/images/admin/tp/section_menu_bg.gif) repeat-y scroll 100% 0pt;">
        <br />
        <?php include_component('places', 'list') ?>
      </div>

      <div style="float:right; width:50%; height:160px; padding-right: 20px; margin-bottom: 20px; background:transparent url(/images/admin/tp/section_menu_bottom.gif) no-repeat scroll 100% 100%">
        <ul class="tv_admin_actions">
          <!-- Falta -->
          <li>
            <?php echo button_to_function(__('nuevo'), 'Modalbox.show("places/create", {title:"' . __('Crear nuevo lugar') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?>
          </li>
        </ul>
      </div>

      <select id="options_places" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('place', $('options_places'))">
        <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
        <option disabled="">---</option>
        <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
        <option value="create"><?php echo __('Crear nuevo')?></option>
      </select>
    </div>

    <div style="width:44%; float:left; padding-left:5px; border-top: 1px solid #bebebe ">
      <div id="list_precincts" name="list_precincts" act="/precincts/list" style="padding-right: 20px; background:transparent url(/images/admin/tp/section_menu_bg_r.gif) repeat-y scroll 100% 0pt; padding-top: 15px">
        <?php include_component('precincts', 'list') ?>
      </div>

      <div style="float:right; width:50%; height:160px; padding-right: 20px; margin-bottom: 20px; background:transparent url(/images/admin/tp/section_menu_bottom_r.gif) no-repeat scroll 100% 100%">
        <ul class="tv_admin_actions">
          <!-- Falta -->
          <li>
            <?php echo button_to_function(__('nuevo'), 'Modalbox.show("precincts/create", {title:"' . __('Crear nuevo recinto en el lugar seleccionado') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?>
          </li>
        </ul>
      </div>

      <select id="options_precincts" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('precinct', $('options_precincts'))">
        <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
        <option disabled="">---</option>
        <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
        <option value="create"><?php echo __('Crear nuevo')?></option>
      </select>
    </div>
  </div>
</div>