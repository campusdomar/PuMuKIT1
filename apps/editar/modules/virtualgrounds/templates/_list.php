<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('ground', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%">Id</th>
      <th>Cod</th>
      <th>Nombre</th>
      <th>Obj. MM.</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($grounds) == 0):?>
    <tr>
      <td colspan="9">
       No existen areas con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($grounds as $ground): $odd = fmod(++$i, 2); $numS = $ground->countGroundMms()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($ground->getId() == $sf_user->getAttribute('id', null, 'tv_admin/ground')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $ground->getId()?>" class="ground_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('ground', this, <?php echo $ground->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'grounds/edit?id=' . $ground->getId(), array('title' => 'Editar area de conocimiento "'.$ground->getName() . '"'), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_grounds', 'url' => 'grounds/delete?id='.$ground->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar este area?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_grounds', 'url' => 'grounds/copy?id='.$ground->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <?php echo m_link_to(image_tag('admin/mbuttons/relation_inline.gif', 'alt=editar title=editar'), 'grounds/showrelations?id=' . $ground->getId(), array('title' => 'Editar relaciones del area "'.$ground->getName(). '"'), array('width' => '800')) ?>
      </td>
      <td onclick="click_fila('ground', this, <?php echo $ground->getId() ?>);">
        <?php echo $ground->getId() ?>
      </td>
      <td onclick="click_fila('ground', this, <?php echo $ground->getId() ?>);">
        <?php echo $ground->getCod(); ?>
      </td>
      <td onclick="click_fila('ground', this, <?php echo $ground->getId() ?>);">
        <?php echo $ground->getName(); ?>
      </td>
      <td onclick="click_fila('ground', this, <?php echo $ground->getId() ?>);">
        <?php echo $numS?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'ground', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_ground ?>/<?php echo $total_ground_all ?> Areas
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>