<span class="trans_button" onclick="$('list_announces_<?php echo $serial['id']?>').toggle()"><?php echo image_tag('admin/mbuttons/email_inline.gif', 'alt=opciones title=opciones')?>
<div class="trans_menu" id="list_announces_<?php echo $serial['id']?>" style="display:none">

  <div class="mas_info" style="">
    <div class="trans_button_up"><img src="/images/admin/mbuttons/email_inline.gif" alt="opciones" /></div>
    <div class="trans_button_info">Opciones:</div>
  </div>

  <div class="list_options">
    <ul style="">
      <!-- TODO en actions -->
   <?php $announces = AnnounceChannelPeer::doSelect(new Criteria());  if(count($announces) == 0):?>
      <li class="normal"> No existe ningun canal personal.</li>
      <?php else: ?>
      <li class="normal">
         <?php echo link_to_remote('Todos', array(
          'update' => 'list_serials', 
          'url' => 'serials/announcech?type=all&id='.$serial['id'], 
          'script' => 'true', 
          'confirm' => 'Seguro que desea anunciar la serie "' . $serial['title'] . '"', 
        )); ?>
      </li>
    
      <?php foreach($announces as $announce):?>
      <li class="normal">
        <?php echo link_to_remote($announce->getName(), array(
          'update' => 'list_serials', 
          'url' => 'serials/announcech?type=' . $announce->getId() . '&id='.$serial['id'], 
          'script' => 'true', 
          'confirm' => 'Seguro que desea anunciar la serie "' . $serial['title'] . '"', 
        )); ?>
      </li>
      <?php endforeach?>
      <?php endif?>
      <li class="cancel"><a href="#" onclick="return false;">Cancelar...</a></li>

    </ul>


  </div>
</div>
</span>

