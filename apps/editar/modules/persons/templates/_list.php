<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('person', this.checked)">
      </th>
      <th colspan="3" width="5%"></th>
      <?php include_partial('list_th')?>
      <th width="1%"><?php echo __('V&iacute;deos')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($persons) == 0):?>
  <tr>
      <td colspan="9">
       <?php echo __('No existen personas con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($sf_data->getRaw('persons') as $person): $odd = fmod(++$i, 2); $numV = $person->countMmPersons()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($person->getId() == $sf_user->getAttribute('id', null, 'tv_admin/person')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $person->getId()?>" class="person_checkbox" type="checkbox">
      </td>
      <td>
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'persons/edit?id=' . $person->getId(), array('title' => __('Editar Persona "').$person->getHName() . '"'), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_persons', 'url' => 'persons/delete?id='.$person->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar los datos de "') . $person->getHName() . '"?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_persons', 'url' => 'persons/copy?id='.$person->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila('person', this, <?php echo $person->getId() ?>);">
        <?php echo $person->getId() ?>
      </td>
      <td onclick="click_fila('person', this, <?php echo $person->getId() ?>);">
        <span style="color:gray"><?php echo trim($person->getHonorific().' </span>'.$person->getName().'&nbsp;'); ?>
      </td>
      <td onclick="click_fila('person', this, <?php echo $person->getId() ?>);">
        <?php $value = $person->getEmail(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('person', this, <?php echo $person->getId() ?>);">
        <?php $value = $person->getPhone(); echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td onclick="click_fila('person', this, <?php echo $person->getId() ?>);">
        <?php echo $numV  ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="9">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'person', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_person ?>/<?php echo $total_person_all ?> <?php echo __('Personas')?>
        <?php $aux = ($total_person==$total_person_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_persons").reset();', 'update' => 'list_persons', 'url' => 'persons/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>
  
<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>