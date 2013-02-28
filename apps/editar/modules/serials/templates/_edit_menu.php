<span class="trans_button" onclick="$('list_pics_<?php echo $serial['id']?>').toggle()"><?php echo image_tag('admin/mbuttons/edit_inline.gif', 'alt=opciones title=opciones')?>
<div class="trans_menu" id="list_pics_<?php echo $serial['id']?>" style="display:none">

  <div class="mas_info" style="">
    <div class="trans_button_up"><img src="/images/admin/mbuttons/edit_inline.gif" alt="opciones" /></div>
    <div class="trans_button_info">Opciones:</div>
  </div>

  <div class="list_options">
    <ul style="">

      <li class="normal">
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar ') ." Borrar la serie", array(
          'update' => 'list_serials', 
          'url' => 'serials/delete?id='.$serial['id'], 
          'script' => 'true', 
          'confirm' => 'Seguro que desea borrar la serie "' . $serial['title'] . '", tiene '.$numV.' objetos multimedia', 
          'success' => '$("vista_previa_serial").innerHTML="<h2>select serial</h2>";$("edit_serials").innerHTML="<h2>select serial</h2>"; ')
        ); ?>
      </li>
      <li class="normal">
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar class=miniTag') . " Clonar la serie", array(
          'update' => 'list_serials', 
          'url' => 'serials/copy?id='.$serial['id'], 
          'script' => 'true')
        )?>
      </li>

      <li class="normal">
        <?php echo m_link_to(image_tag('admin/bbuttons/00_inline.gif', array('alt' => '??', 'title'=>'estado', 'id'=>'table_serials_status_' . $serial['id'])) . " Modificar difusi&oacute;n de los objetos multimedia", 'serials/changePub?serial=' . $serial['id'], array('title' => 'Cambiar difusion de los objetos multimedia'), array('width' => '925')) ?>
      </li>

      <li class="normal">
        <?php echo link_to_remote(image_tag('admin/mbuttons/edit_template_inline.gif', 'alt=editar title=editar class=miniTag') . " Modificar valores por defecto de los objetos multimedia", array('update' => 'edit_serials', 'url' => 'mmtemplates/edit?id='.$serial['id'], 'script' => 'true')); ?>
      </li>

      <li class="normal">
        <?php echo m_link_to(image_tag('admin/mbuttons/info_inline.gif', 'alt=info title=info') . " Informacion de la serie", 'serials/info?id=' . $serial['id'], array('title' => 'Informacion de la series'), array('width' => '925')) ?>
      </li>
      <li class="cancel"><a href="#" onclick="return false;">Cancelar...</a></li>

    </ul>


  </div>
</div>
</span>

