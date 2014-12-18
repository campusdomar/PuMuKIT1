<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('serialtype', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%">Id</th>
      <th>Nombre</th>
      <th>Series</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($serialtypes) == 0):?>
    <tr>
      <td colspan="8">
       No existen tipos de series con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($serialtypes as $serialtype): $odd = fmod(++$i, 2); $numS = $serialtype->countSerials()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($serialtype->getId() == $sf_user->getAttribute('id', null, 'tv_admin/serialtype')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $serialtype->getId()?>" class="serialtype_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('serialtype', this, <?php echo $serialtype->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'serialtypes/edit?id=' . $serialtype->getId(), array('title' => 'Editar tipo de serie '.$serialtype->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_serialtypes', 'url' => 'serialtypes/delete?id='.$serialtype->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar este tipo?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_serialtypes', 'url' => 'serialtypes/copy?id='.$serialtype->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_serialtype" title="Selecrionar este serialtype por defecto"
               value="serialtype_<?php echo $serialtype->getId()?>" 
               <?php echo $serialtype->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/serialtypes/default/id/<?php echo $serialtype->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('serialtype', this, <?php echo $serialtype->getId() ?>);">
        <?php echo $serialtype->getId() ?>
      </td>
      <td onclick="click_fila('serialtype', this, <?php echo $serialtype->getId() ?>);">
        <?php echo $serialtype->getName(); ?>
      </td>
      <td onclick="click_fila('serialtype', this, <?php echo $serialtype->getId() ?>);">
        <?php echo $numS?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="8">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'serialtype', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_serialtype ?>/<?php echo $total_serialtype_all ?> Tipos
        <?php $aux = ($total_serialtype==$total_serialtype_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar busqueda', array('before' => '$("filter_serialtypes").reset();', 'update' => 'list_serialtypes', 'url' => 'serialtypes/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>