<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('cpu', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <th width="1%">Id</th>
      <th>IP</th>
      <th>Tipo</th>
      <th>Mínimo</th>
      <th>Máximo</th>
      <th>Número</th>
      <th>Estado Conexión</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($cpus) == 0):?>
    <tr>
      <td colspan="10">
       No existen noticias con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($cpus as $cpu): $odd = fmod(++$i, 2);?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($cpu->getId() == $sf_user->getAttribute('id', null, 'tv_admin/cpu')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $cpu->getId()?>" class="cpu_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'cpus/edit?id=' . $cpu->getId(), array('title' => 'Editar Novedad '.$cpu->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_cpus', 'url' => 'cpus/delete?id='.$cpu->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_cpus', 'url' => 'cpus/copy?id='.$cpu->getId(), 'script' => 'true'))?>
      </td>
      
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <?php echo $cpu->getId() ?>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <?php echo $cpu->getIp(); ?>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
      <?php echo $cpu->getType(); ?>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <?php echo $cpu->getMin(); ?>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <?php echo $cpu->getMax()?>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
        <span style="font-weight: bold"><?php echo $cpu->getNumber()?></span>
      </td>
      <td onclick="click_fila('cpu', this, <?php echo $cpu->getId() ?>);">
      <?php echo $cpu->isActive() ? 'OK' : '<span style="color:red;">KO</span>' ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="11">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'cpu', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_cpu ?>/<?php echo $total_cpu_all ?> cpu
      </th>
    </tr>
  </tfoot>
</table>
