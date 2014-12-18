<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="">
      </th>
      <th width="1%">Img</th>
      <th>Id</th>
      <th>Nombre</th>
      <th>Series</th>
      <th>Duracion</th>
      <th>Fecha</th>
      <th></th>
    </tr>
  </thead>
  
  <tbody>
    <?php if(count($media_packages) == 0):?>
      <tr>
        <td colspan="6">
          El sistema matterhorn no posee grabaciones.
          <?php if (strlen($sf_user->getAttribute('q', '', 'tv_admin/matterhorn')) > 0): ?>
            <a href="#" onclick="$('filter_matterhorn').reset(); new Ajax.Updater('list_matterhorn', '/editar.php/matterhorn/list/reset/true', {asynchronous:true, evalScripts:true}); return false;">Reset filter</a>
          <?php endif?>
        </td>
      </tr>
    <?php endif?>

    <?php $i = 0; foreach($media_packages as $mp): $i++?>
      <tr class="tv_admin_row_<?php echo $i%2?>" >
        <td style="cursor: auto">
          <input class="profile_checkbox" type="checkbox">
        </td> 
        <td style="cursor: auto"><img class="mini" src="<?php echo is_null($mp['img']) ? '/images/sin_foto.jpg' : $mp['img']  ?>" height="23" width="30" /></td> 
        <td style="cursor: auto"><?php echo $mp["id"] ?></td> 
        <td style="cursor: auto"><?php echo $mp["title"] ?></td> 
        <td style="cursor: auto"><?php echo $mp["serial_id"] ?></td> 
        <td style="cursor: auto"><?php echo ($mp["duration"]/1000) ?></td> 
        <td style="cursor: auto"><?php echo date("d-m-Y", $mp["date"]) ?></td> 
        <td style="cursor: auto">
          <?php if($mp['mm'] === NULL):?>
            <a href="#" onclick="new Ajax.Updater('list_matterhorn', '<?php echo url_for('matterhorn/import?id=' . $mp['id']) ?>', {
               asynchronous:true, evalScripts:true, onSuccess:function(r,j){matterhorn_info('Importacion realizada correctamente')}}); return false;">import</a>
          <?php else:?>
            <a href="<?php echo url_for('mms/index?serial=' . $mp['mm']->getSerialId() . '&id=' . $mp['mm']->getId()) ?>">YA IMPORTADO</a>
          <?php endif?> |
          <a target="_black" href="<?php echo $mh_server ?>/engage/ui/watch.html?id=<?php echo $mp['id']?>">play</a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="12">
        <div class="float-right">
          <?php include_partial('pager_ajax', array('name' => 'matterhorn', 'page' => $page, 'total' => $total_page)) ?> 
        </div>
        <?php echo $total ?> grabaciones
      </th>
    </tr>
  </tfoot>

</table> 
