<span class="trans_button" onclick="$('list_announces_<?php echo $mm['id']?>').toggle()"><?php echo image_tag('admin/mbuttons/email_inline.gif', 'alt=' . __('opciones') . ' title=' . __('opciones'))?>
<div class="trans_menu" id="list_announces_<?php echo $mm['id']?>" style="display:none">

  <div class="mas_info" style="">
    <div class="trans_button_up"><img src="/images/admin/mbuttons/email_inline.gif" alt="<?php echo __('opciones')?>" /></div>
    <div class="trans_button_info"><?php echo __('Opciones:')?></div>
  </div>

  <div class="list_options">
    <ul style="">
      <!-- TODO en actions -->
      <?php $announces = AnnounceChannelPeer::doSelect(new Criteria()); if(count($announces) == 0):?>
        <li class="normal"> <?php echo __('No existe ningún canal personal.')?></li>
      <?php else: ?>
      <li class="normal">
         <?php echo link_to_remote(__('Todos'), array(
          'update' => 'list_mms', 
          'url' => 'mms/announcech?type=all&id='.$mm['id'], 
          'script' => 'true', 
          'confirm' => '¿Seguro que desea anunciar el objeto multimedia "' . $mm['title'] . '"?', 
        )); ?>
      </li>
    
      <?php foreach($announces as $announce):?>
      <li class="normal">
        <?php echo link_to_remote($announce->getName(), array(
          'update' => 'list_mms', 
          'url' => 'mms/announcech?type=' . $announce->getId() . '&id='.$mm['id'], 
          'script' => 'true', 
          'confirm' => __('¿Seguro que desea anunciar el objeto multimedia "') . $mm['title'] . '"?', 
        )); ?>
      </li>
      <?php endforeach?>
      <?php endif?> 
      <li class="cancel"><a href="#" onclick="return false;"><?php echo __('Cancelar...')?></a></li>

    </ul>


  </div>
</div>
</span>

