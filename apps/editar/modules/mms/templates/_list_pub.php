<?php $pubs = PubChannelPeer::doSelect(new Criteria()); foreach($pubs as $p): ?>
    <?php if($p->getEnable() == 0):?>
      <div style="color: grey">
        <input type="checkbox" disabled="disabled" />  <?php echo $p->getName()?>
      </div>
    <?php else:?>
      <div>
        <!-- SOLO UNA QUERY-->
        <?php $estado = $p->hasMm($mm->getId()) ?>
          <input type="checkbox" 
               onchange="$('remember_save_mm_pub').show()" 
               name="pub_channels[<?php echo $p->getId()?>]" 
               class="pub_channel_input_checkbox"
               <?php echo ($estado !== 0)?'checked="checked"':""?>
               <?php echo (($estado === 2)||($estado === 3))?'disabled="disabled"':''?>
        />
        <?php echo $p->getName()?>
        <?php if($estado === 2):?>
          <span style="font-size: 80%; font-style:italic;">(Se  estan codificando los archivos necesarios)</span>
        <?php elseif($estado === 3):?>
          <span style="font-size: 80%; font-style:italic;">(Esperando master para codificar los archivos necesarios)</span>
        <?php endif ?>
      </div>
    <?php endif ?>
<?php endforeach ?>
