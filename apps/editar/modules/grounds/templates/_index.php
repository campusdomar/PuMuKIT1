<div class="entry-edit">
  <h4 class="icon-head head-edit-form fieldset-legend">
    <?php //echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'grounds/edit?id=' . $type->getId(), array('title' => __('Editar Novedad ').$type->getId()), array('width' => '800')) FALTA editar groundtype?> 
    <?php echo $type->getName()?>
  </h4>
</div>

<br />
<?php echo $type->getName() ?> (<?php echo $type->getDescription() ?>) 
<br />
<input type="checkbox" 
  <?php echo $type->getDisplay()?'checked="checked"':'' ?>
  onchange="new Ajax.Request('/editar.php/grounds/showtype/id/<?php echo $type->getId()?>/value/'+this.checked, {asynchronous: true, evalScripts: true});">  
  <?php echo __('Usar')?>
<br />
<br/>


<div id="tv_admin_container">
  <div id="tv_admin_content" style="margin-right: 0px; margin-left: 25px">
    <div id="" class="list_grounds_<?php echo $type->getId()?> list_grounds" act="/grounds/list">
      <?php include_component('grounds', 'list', array('type' => $type->getId())) ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php echo button_to_function(__('nueva'), 'Modalbox.show("grounds/create/type/'.$type->getId().'", {title:"' . __('Crear nueva área de este tipo') . '", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>
    

    <select id="options_grounds" style="margin: 10px 0px; width: 33%" title="<?php echo __('Acciones sobre elementos seleccionados')?>" onchange="window.change_select('ground', this)">
      <option value="default" selected="selected"><?php echo __('Selecciona una acci&oacute;n...')?></option>
      <option disabled="">---</option>
      <option value="delete_sel"><?php echo __('Borrar seleccionados')?></option>
    </select>

  </div>
</div>
