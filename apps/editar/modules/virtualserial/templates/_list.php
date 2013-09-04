<div style="width: 100%;">
<div style="overflow: hidden;">
<div id="faceted_search">
  <?php include_partial('search', array('years' => $sf_data->getRaw('years'),
                                      'genres' => $sf_data->getRaw('genres'), 
                                      'roles' => $sf_data->getRaw('roles'))) ?>
</div>
<!--
    <div style="float:right;">
      <ul class="tv_admin_actions">
        <li style="float: left;">
          <?php echo link_to_function('Wizard', "Modalbox.show('".url_for("wizard/serial"). '?mod=virtualserial' . "',{width: 800, title:'PASO I: Series Virtuales'})", 'class=tv_admin_action_next') ?>
        </li>
      </ul>
    </div>
-->
</div>

<div style="position:relative">
  <?php if (count($mms) == 0):?>
    <div id="NoOOMMMessage" style="position: absolute; top: 110px; left: 38%; font-size: 20px; width: 25%; font-weight: bold;">
       <p>No existen objetos multimedia con esos valores.</p>
    </div>
  <?php endif; ?>
<table cellspacing="0" class="tv_admin_list" style="float:left;">
  <thead>
    <tr>
      <th width="1%" style="padding-left: 5px">
        <input type="checkbox" onclick="window.click_checkbox_all('mm', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <?php if(sfConfig::get('app_mail_use')):?>
      <th width="2%"></th>
      <?php endif?>
      <th width="1%">Audio/Video</th>
      <th width="1%">Img</th>
      <?php include_partial('list_th') ?>
    </tr>
  </thead>

  <tbody>
  <?php $t = count($mms) ; for( $i=0; $i<$t; $i++): $mm = $mms[$i]; $odd = fmod($i, 2) ?>
     <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($mm['id'] == $sf_user->getAttribute('id', null, 'tv_admin/virtualserial')) echo ' tv_admin_row_this'?>">
      <td class="grippy" draggable="true" data-id="<?php echo $mm['id']?>">
        <input id="<?php echo $mm['id']?>" class="mm_checkbox" type="checkbox">
      </td>
      <td style="padding: 0.2%;">
	<?php echo image_tag('admin/bbuttons/mm'.$mm['status'].'_inline.gif', 'alt='.$mm['status'].' title='.MmPeer::getStatusText($mm['status']).' class=miniTag id=table_mms_status_' . $mm['id']) ?>
      </td>
      <td style="padding: 0.2%;">
        <?php echo ($mm['announce']?'<span style="color: blue" title="Novedad">A</span>':'&nbsp;') ?>
      </td>
       <td style="padding: 0.2%;">
          <a href="#" onclick="
             if (window.confirm('Seguro que desea borrar el objeto multimedia?')) {
                $('search_loading_img').show();
                new Ajax.Updater('mm_mms', '<?php echo url_for("virtualserial/delete") . "/id/" . $mm['id']?>', {
                   asynchronous:true,
                   evalScripts:true,
                   onComplete: function(){ $('search_loading_img').hide(); },
                   onSuccess:function(request, json){
                      $('vista_previa_mm').innerHTML='';
                      $('edit_mms').innerHTML=''; 
                   }
                });
                update_tree();
             }; return false;">
             <img alt="borrar" title="borrar" class="miniTag" src="/images/admin/mbuttons/delete_inline.gif">
          </a>
      </td>
      <td>
        <?php include_partial("virtualserial/edit_menu", array('mm' => $mm))?>
      </td> 
      <?php if(sfConfig::get('app_mail_use')):?>
      <td style="padding: 0.2%;">
        <?php include_partial("mms/edit_announce", array('mm' => $mm))?>
      </td>
      <?php endif?>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
         <?php echo ($mm['audio']) ? 'Audio':'Video'?>
      </td>


      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <?php echo image_tag($mm['pic_url'], 'class=mini size=30x23')?>
      </td>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <?php echo $mm['id']?>
      </td>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <a href="<?php echo url_for("mms/index?serial=" . $mm['serial_id'])?>"><?php echo $mm['serial_id']?></a>
      </td>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <?php $value = $mm['title']; echo $value ? $value : '&nbsp;'  ?>
      </td>
      <td style="padding: 0.2%;">
        <?php echo FilePeer::getDurationString($mm['duration']); ?>
      </td>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <?php echo $mm['publicdate']; ?>
      </td>
      <td onclick="click_fila_virtualserial(this, <?php echo $mm['id'] ?>)" style="padding: 0.2%;">
        <?php echo $mm['recorddate']; ?>
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
      </tr>
    <?php endfor; ?>
  <?php endif; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="15">
        <div class="float-right">
          <?php include_partial('virtual_pager_ajax', array('name' => 'mm', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_mm ?> Obj. Mm.
      </th>
    </tr>
  </tfoot>
</table>
</div>
</div>
<?php if ($error != '') :?>
<div id="error_lucene" style="padding: 10px; background-color: #eef; border-radius: 5px; font-size: 15px; font-weight: bold; position:absolute; top: 200px; left: 650px; z-index: 5; width: 300px;"><?php echo "Su búsqueda produjo el error: " . $error . "\n" ?></div>
<?php echo javascript_tag("
  Effect.Fade('error_lucene',{duration: 5.0});
"); ?>
<?php endif;?>
<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>

<?php if (isset($reload_pub_channel)): ?>
  <?php echo javascript_tag("
    new Ajax.Updater('list_pub_" . $mm_sel->getId() . "', '" . url_for('mms/updatelistpub?id=' . $mm_sel->getId()) . "')
  "); ?>
<?php endif ?>

<?php if(isset($reloadEditAndPreview)): ?>
<?php echo javascript_tag("
     mmSelId = " . $sf_user->getAttribute('id', 'null', 'tv_admin/virtualserial') . "; //Se actualiza en click_fila_virtualserial
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



<?php echo javascript_tag("
function listHandleDragStart(e) {
  //console.log('LIST dragstart');

  var checkbox_list = document.querySelectorAll(\"input.mm_checkbox[type='checkbox']:checked\");
  //Si no hay checkbox selecionado e.preventDefault();
  if(checkbox_list.length == 0) e.preventDefault();

  
  var dragIcon = document.createElement('img');
  dragIcon.src = document.getElementById('dnd_imange_' + checkbox_list.length).src;
  dragIcon.width = 35;
  e.dataTransfer.setDragImage(dragIcon, 0, 0)

  dragElement = 'list';
  
  var aux_list = [];
  for (var i = 0; i < checkbox_list.length; i++) {
    aux_list.push(checkbox_list[i].getAttribute('id'));
  }
  dragDataElement = aux_list;
  e.dataTransfer.setData('id', aux_list);
}


function listHandleDragEnd(e) {
  //console.log('LIST dragend');
  dragElement = dragDataElement = null;
}

var nodes = document.querySelectorAll('.grippy');
[].forEach.call(nodes, function(node) {
  node.addEventListener('dragstart', listHandleDragStart, false);
  node.addEventListener('dragend', listHandleDragEnd, false);
});
") ?>