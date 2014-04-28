<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('codec', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Files')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($codecs) == 0):?>
    <tr>
      <td colspan="9">
       <?php echo __('No existen noticias con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($codecs as $codec): $odd = fmod(++$i, 2); $numF = $codec->countFiles()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($codec->getId() == $sf_user->getAttribute('id', null, 'tv_admin/codec')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $codec->getId()?>" class="codec_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('codec', this, <?php echo $codec->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'codecs/edit?id=' . $codec->getId(), array('title' => __('Editar Novedad ').$codec->getId()), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_codecs', 'url' => 'codecs/delete?id='.$codec->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_codecs', 'url' => 'codecs/copy?id='.$codec->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila('codec', this, <?php echo $codec->getId() ?>);">
        <?php echo $codec->getId() ?>
      </td>
      <td>
        <input type="radio" name="radio_codec" title="<?php echo __('Seleccionar este códec por defecto')?>"
               value="codec_<?php echo $codec->getId()?>" 
               <?php echo $codec->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/codecs/default/id/<?php echo $codec->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('codec', this, <?php echo $codec->getId() ?>);">
        <?php echo $codec->getName(); ?>
      </td>
      <td onclick="click_fila('codec', this, <?php echo $codec->getId() ?>);">
        <?php echo $numF?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'codec', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_codec ?>/<?php echo $total_codec_all ?> <?php echo __('Códec')?>
      </th>
    </tr>
  </tfoot>
</table>
