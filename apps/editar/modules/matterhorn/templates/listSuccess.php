<?php

function app_editar_matterhorn_list($id)
{
  $c = new Criteria();
  $c->add(MmMatterhornPeer::MH_ID, $id);
  $c->addJoin(MmPeer::ID, MmMatterhornPeer::ID);
  return MmPeer::doSelectOne($c);
}


function app_editar_matterhorn_image($mp)
{
  $img = null;
  
  if(isset($mp["attachments"]) and isset($mp["attachments"]["attachment"])){
    foreach($mp["attachments"]["attachment"] as $attach){
      if(($attach['type'] == "presenter/search+preview") && ($attach['mimetype'] == "image/jpeg")){
	$img = $attach['url'];
      }
    }
  }
  return $img;
}


?>
<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="">
      </th>
      <th width="1%"><?php echo __('Img')?></th>
      <th><?php echo __('Id')?></th>
      <th><?php echo __('Nombre')?></th>
      <th><?php echo __('Series')?></th>
      <th><?php echo __('Duración')?></th>
      <th><?php echo __('Fecha')?></th>
      <th></th>
    </tr>
  </thead>
  
  <tbody>
    <?php if(count($media_packages) == 0):?>
      <tr>
        <td colspan="6">
          <?php echo __('El sistema Matterhorn no posee grabaciones.')?>
          <?php if (strlen($sf_user->getAttribute('q', '', 'tv_admin/matterhorn')) > 0): ?>
            <a href="#" onclick="$('filter_matterhorn').reset(); new Ajax.Updater('list_matterhorn', '/editar.php/matterhorn/list/reset/true', {asynchronous:true, evalScripts:true}); return false;"><?php echo __('Reset filter')?></a>
          <?php endif?>
        </td>
      </tr>
    <?php endif?>

    <?php $i = 0; foreach($media_packages as $mp): $i++;  $mm = app_editar_matterhorn_list($mp["id"]); $img = app_editar_matterhorn_image($mp);?>
      <tr class="tv_admin_row_<?php echo $i%2?>" >
        <td style="cursor: auto">
          <input class="profile_checkbox" type="checkbox">
        </td> 
        <td style="cursor: auto"><img class="mini" src="<?php echo is_null($img) ? '/images/sin_foto.jpg' : $img  ?>" height="23" width="30" /></td> 
        <td style="cursor: auto"><?php echo $mp["id"] ?></td> 
        <td style="cursor: auto"><?php echo $mp["title"] ?></td> 
        <td style="cursor: auto"><?php echo (array_key_exists("seriestitle", $mp))? $mp["seriestitle"] : ""; ?></td> 
        <td style="cursor: auto"><?php echo (array_key_exists("duration", $mp))? ($mp["duration"]/1000) : "Duration not available"; ?></td> 
        <td style="cursor: auto"><?php echo date("d-m-Y", strtotime($mp["start"])) ?></td> 
        <td style="cursor: auto">
          <?php if($mm === NULL):?>
            <a href="#" onclick="new Ajax.Updater('list_matterhorn', '<?php echo url_for('matterhorn/import?id=' . $mp['id']) ?>', {
               asynchronous:true, evalScripts:true, onSuccess:function(r,j){matterhorn_info('<?php echo __('Importación realizada correctamente')?>')}}); return false;"><?php echo __('import')?></a>
          <?php else:?>
            <a href="<?php echo url_for('mms/index?serial=' . $mm->getSerialId() . '&id=' . $mm->getId()) ?>"><?php echo __('YA IMPORTADO')?></a>
          <?php endif?> |
          <a target="_black" href="<?php echo $en_server ?>/engage/ui/watch.html?id=<?php echo $mp['id']?>"><?php echo __('play')?></a>
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
        <?php echo $total ?> <?php echo __('grabaciones')?>
      </th>
    </tr>
  </tfoot>

</table> 
