<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('language', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th width="5%"><?php echo __('Cod')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Files')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($languages) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen idiomas con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($languages as $language): $odd = fmod(++$i, 2); $numF = $language->countFiles()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($language->getId() == $sf_user->getAttribute('id', null, 'tv_admin/language')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $language->getId()?>" class="language_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('language', this, <?php echo $language->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'languages/edit?id=' . $language->getId(), array('title' => __('Editar idioma  ').$language->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_languages', 'url' => 'languages/delete?id='.$language->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_languages', 'url' => 'languages/copy?id='.$language->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_language" title="<?php echo __('Seleccionar este lenguaje por defecto')?>"
               value="language_<?php echo $language->getId()?>" 
               <?php echo $language->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/languages/default/id/<?php echo $language->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('language', this, <?php echo $language->getId() ?>);">
        <?php echo $language->getId() ?>
      </td>
      <td onclick="click_fila('language', this, <?php echo $language->getId() ?>);">
        <?php echo $language->getCod(); ?>
      </td>
      <td onclick="click_fila('language', this, <?php echo $language->getId() ?>);">
        <?php echo $language->getName(); ?>
      </td>
      <td onclick="click_fila('language', this, <?php echo $language->getId() ?>);">
        <?php echo $numF?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'language', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_language ?>/<?php echo $total_language_all ?> <?php echo __('Idiomas')?>
        <?php $aux = ($total_language==$total_language_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_languages").reset();', 'update' => 'list_languages', 'url' => 'languages/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>