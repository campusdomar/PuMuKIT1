<div id="faceted_search" style="width: 100%">
<?php //include_partial('search', array('years' => $sf_data->getRaw('years'),
      //                                'genres' => $sf_data->getRaw('genres'))) ?>
</div>
<table cellspacing="0" class="tv_admin_list" style="float:left;">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('mm', this.checked)">
      </th>
      <th colspan="6" width="5%"></th>
      <?php if(sfConfig::get('app_mail_use')):?>
      <th width="2%"></th>
      <?php endif?>
      <th width="1%">Audio/Video</th>
      <th width="1%">Img</th>
      <th width="1%">Id</th>
      <th>T&iacute;tulo</th>
      <th width="1%">Duración</th>
      <th width="1%">FechaRec</th>
      <th width="1%">FechaPub</th>
    </tr>
  </thead>

  <tbody>
  <?php if (count($mms) == 0):?>
    <div style="position: absolute; top: 310px; left: 30%; font-size: 20px; width: 30%; font-weight: bold;">
       <p>No existen objetos multimedia con esos valores.</p>
    </div>
  <?php endif; ?>
  <?php $t = count($mms) ; for( $i=0; $i<$t; $i++): $mm = $mms[$i]; $odd = fmod($i, 2) ?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($mm['id'] == $sf_user->getAttribute('id', null, 'tv_admin/mm')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $mm['id']?>" class="mm_checkbox" type="checkbox">
      </td>
      <td>
        <?php echo image_tag('admin/bbuttons/mm'.$mm['status'].'_inline.gif', 'alt='.$mm['status'].' title=estado class=miniTag id=table_mms_status_' . $mm['id']) ?>
      </td>
      <td>
        <?php echo ($mm['announce']?'<span style="color: blue" title="Novedad">A</span>':'&nbsp;') ?>
      </td> 
       <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar class=miniTag'), array('update' => 'list_mms', 'url'=> 'mms/delete?id='.$mm['id'], 'script' => 'true', 'confirm' => 'Seguro que desea borrar el objeto multimedia?', 'success' => '$("vista_previa_mm").innerHTML=""; $("edit_mms").innerHTML="" '));?>
      </td>

      <td>
        <?php include_partial("mms/edit_menu", array('mm' => $mm))?>
      </td>
      <?php if(sfConfig::get('app_mail_use')):?>
      <td>
        <?php include_partial("mms/edit_announce", array('mm' => $mm))?>
      </td>
      <?php endif?>
      <td>
	 <?php echo ((($page == 1)&&( $i == 0)) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'list_mms', 'url' => 'mms/up?id='.$mm['id'], 'script' => 'true'), array('title' => 'Mover una posición hacia arriba'))).(link_to_remote('&#8657;', array('update' => 'list_mms', 'url' => 'mms/top?id='.$mm['id'], 'script' => 'true'), array('title' => 'Mover al inicio de la lista'))))   ?>
      </td>
      <td>
	 <?php echo ((($page == $total)&&( $i == $t-1))? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'list_mms', 'url' => 'mms/down?id='.$mm['id'], 'script' => 'true'), array('title' => 'Mover una posición hacia abajo'))).(link_to_remote('&#8659;', array('update' => 'list_mms', 'url' => 'mms/bottom?id='.$mm['id'], 'script' => 'true'), array('title' => 'Mover al final de la lista')))) ?>
      </td>
      <td>
         <span><?php echo ($mm['audio']) ? 'Audio':'Video'?></span>
      </td>
      <td onclick="click_fila_edit('mm', this, <?php echo $mm['id'] ?>)" >
        <?php echo image_tag($mm['pic_url'], 'class=mini size=30x23')?>
      </td>
      <td onclick="click_fila_edit('mm', this, <?php echo $mm['id'] ?>)" >
        <?php echo $mm['id']?>
      </td>
      <td onclick="click_fila_edit('mm', this, <?php echo $mm['id'] ?>)" >
        <?php $value = $mm['title']; echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td>
        <?php echo FilePeer::getDurationString($mm['duration']); ?>
      </td>
      <td onclick="click_fila_edit('mm', this, <?php echo $mm['id'] ?>)">
        <?php echo $mm['recorddate']; ?>
      </td>
      <td onclick="click_fila_edit('mm', this, <?php echo $mm['id'] ?>)" >
        <?php echo $mm['publicdate']; ?>
      </td>
    </tr>
  <?php endfor; ?>
  <?php if ($t<11): ?>
    <?php for ($i=0;$i<(11-$t); $i++): $odd = fmod($i, 2)?>
       <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?>">
	<td style="height: 23px; padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
        <td style="padding: 0.2%;"></td>
      </tr>
    <?php endfor; ?>
  <?php endif; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="14">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'mm', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_mm ?> Obj. Mm.
      </th>
    </tr>
  </tfoot>
</table>

<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>

<?php if (isset($reload_pub_channel)): ?>
  <?php echo javascript_tag("
    new Ajax.Updater('list_pub_" . $mm_sel->getId() . "', '" . url_for('mms/updatelistpub?id=' . $mm_sel->getId()) . "')
  "); ?>
<?php endif ?>

<?php if(isset($reloadEditAndPreview)): ?>
<?php echo javascript_tag("
  new Ajax.Updater('edit_mms', '" . url_for('mms/edit') . "', {
      asynchronous: true, 
      evalScripts: true,
      parameters: {id: " . $mm_sel->getId() ."}
  });
  new Ajax.Updater('preview_mm', '" . url_for('mms/preview') . "', {
      asynchronous: true, 
      evalScripts: true,
      parameters: {id: " . $mm_sel->getId() ."}
  });
"); ?>
<?php endif ?>

<?php if (isset($enBloq)): ?>
  <?php echo javascript_tag("
    $('list_pub_channel').setStyle('background-color: #f2f2f2');
    $$('.pub_channel_input_checkbox').invoke('disable');
  "); ?>
<?php endif ?>


<?php if (isset($desBloq)): ?>
  <?php echo javascript_tag("
    $('list_pub_channel').setStyle('background-color: transparent');
    $$('.pub_channel_input_checkbox').invoke('enable');
  "); ?>
<?php endif ?>

