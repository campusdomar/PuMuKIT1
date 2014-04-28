<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('genre', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Vídeos')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($genres) == 0):?>
    <tr>
      <td colspan="8">
       <?php echo __('No existen géneros con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($genres as $genre): $odd = fmod(++$i, 2); $numV = $genre->countMms()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($genre->getId() == $sf_user->getAttribute('id', null, 'tv_admin/genre')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $genre->getId()?>" class="genre_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('genre', this, <?php echo $genre->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'genres/edit?id=' . $genre->getId(), array('title' => __('Editar género ')  .$genre->getName() ), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_genres', 'url' => 'genres/delete?id='.$genre->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar este género?')))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_genres', 'url' => 'genres/copy?id='.$genre->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_genre" title="<?php echo __('Seleccionar este género por defecto')?>"
               value="genre_<?php echo $genre->getId()?>" 
               <?php echo $genre->getDefaultSel()?'checked="checked"':'' ?>
               onchange="new Ajax.Request('/editar.php/genres/default/id/<?php echo $genre->getId() ?>/value/'+ this.checked, {asynchronous:true, evalScripts:true})"
        >
      </td>
      <td onclick="click_fila('genre', this, <?php echo $genre->getId() ?>);">
        <?php echo $genre->getId() ?>
      </td>
      <td onclick="click_fila('genre', this, <?php echo $genre->getId() ?>);">
        <?php echo $genre->getName(); ?>
      </td>
      <td onclick="click_fila('genre', this, <?php echo $genre->getId() ?>);">
        <?php echo $numV?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="8">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'genre', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_genre ?>/<?php echo $total_genre_all ?> <?php echo __('Géneros')?>
        <?php $aux = ($total_genre==$total_genre_all?'display:none; ':'')?>
        <?php echo link_to_remote(__('Cancelar búsqueda'), array('before' => '$("filter_genres").reset();', 'update' => 'list_genres', 'url' => 'genres/list?filter=filter ', 'script' => 'true'), array('title' => __('Cancelar la búsqueda actual'), 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
