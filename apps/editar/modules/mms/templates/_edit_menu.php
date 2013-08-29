<span class="trans_button" onclick="$('list_pics_<?php echo $mm['id']?>').toggle()"><?php echo image_tag('admin/mbuttons/edit_inline.gif', 'alt=opciones title=opciones')?>
<div class="trans_menu" id="list_pics_<?php echo $mm['id']?>" style="display:none">

  <div class="mas_info" style="">
    <div class="trans_button_up"><img src="/images/admin/mbuttons/edit_inline.gif" alt="opciones" /></div>
    <div class="trans_button_info">Opciones:</div>
  </div>

  <div class="list_options">
    <ul style="">

      <li class="normal">
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar class=miniTag'). ' Borrar objeto multimedia', array(
                   'update' => 'list_mms', 
                   'url' => 'mms/delete?id='.$mm['id'], 
                   'script' => 'true', 
                   'confirm' => 'Seguro que desea borrar el objeto multimedia?', 
                   'success' => '$("vista_previa_mm").innerHTML=""; $("edit_mms").innerHTML="" '));?>
      </li>
      <li class="normal">
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar class=miniTag'). 'Clonar objeto multimedia', array(
                   'update' => 'list_mms', 
                   'url' => 'mms/copy?id='.$mm['id'], 
                   'script' => 'true'))?>

      </li>
      <li class="normal">
      <?php echo m_link_to(image_tag('admin/mbuttons/info_inline.gif', 'alt=info title=info') . " Informacion del objeto multimedia", 'mms/info?id='.$mm['id'], array(
		   'title' => 'Info Archivo de Mm '.$mm['id']), array('width' => '800')) ?>
      </li>

      <li class="cancel"><a href="#" onclick="return false;">Cancelar...</a></li>

    </ul>


  </div>
</div>
</span>

