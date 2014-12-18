<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('genre', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%">Id</th>
      <th>Name</th>
      <th>Videos</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($genres) == 0):?>
    <tr>
      <td colspan="8">
       No existen generos con esos valores.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($genres as $genre): $odd = fmod(++$i, 2); $numV = $genre->countMms()?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($genre->getId() == $sf_user->getAttribute('id', null, 'tv_admin/genre')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $genre->getId()?>" class="genre_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('genre', this, <?php echo $genre->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 'genres/edit?id=' . $genre->getId(), array('title' => 'Editar genero  "'.$genre->getName() . '"'), array('width' => '800')) ?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), array('update' => 'list_genres', 'url' => 'genres/delete?id='.$genre->getId(), 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar este genero?'))?>
      </td>
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=copiar title=copiar'), array('update' => 'list_genres', 'url' => 'genres/copy?id='.$genre->getId(), 'script' => 'true'))?>
      </td>
      <td>
        <input type="radio" name="radio_genre" title="Selecrionar este genre por defecto"
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
        <?php echo $total_genre ?>/<?php echo $total_genre_all ?> Generos
        <?php $aux = ($total_genre==$total_genre_all?'display:none; ':'')?>
        <?php echo link_to_remote('Cancelar busqueda', array('before' => '$("filter_genres").reset();', 'update' => 'list_genres', 'url' => 'genres/list?filter=filter ', 'script' => 'true'), array('title' => 'Cancelar la busqueda actual', 'style' => 'color:blue; font-weight:normal;'.$aux)) ?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
