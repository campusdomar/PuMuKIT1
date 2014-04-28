  <br />
  <?php foreach($cpus as $cpu): ?>
  <div style="text-align:center; color: rgb(0, 0, 0);">
    <span style="font-weight: bold"><?php echo __('IP:')?>&nbsp;</span>
    <span style="color: rgb(0, 0, 0);"><?php echo $cpu->getIp()?></span>
    <span style="font-weight: bold">&nbsp;--&nbsp;N&#186; m&aacute;x. proc. <?php echo __('permitidos:')?>&nbsp;</span>
    <span style="color: rgb(0, 0, 0);"><?php echo $cpu->getNumber()?></span>
    <span>
      <?php
        if ($cpu->getNumber() < $cpu->getMax()){ 
          echo link_to_remote(image_tag('admin/transcoder/subir.png', 'alt=' . __('subir') . ' title=' . __('subir')), array('update' => 'cpus_transcoders', 'url' => 'transcoders/cpusup?id='.$cpu->getId(), 'script' => 'true'));
        }
        else echo image_tag('admin/transcoder/subir_off.png', 'alt=' . __('subir') . ' title=' . __('subir'));
      ?>
    </span>
    <span>
      <?php
        if ($cpu->getNumber() > $cpu->getMin()){ 
          echo link_to_remote(image_tag('admin/transcoder/bajar.png', 'alt=' . __('bajar') . ' title=' . __('bajar')), array('update' => 'cpus_transcoders', 'url' => 'transcoders/cpusdown?id='.$cpu->getId(), 'script' => 'true'));
        }
        else echo image_tag('admin/transcoder/bajar_off.png', 'alt='  .__('bajar') . ' title=' . __('bajar'));
      ?>
    </span>
  </div> 
  <br />
  <?php endforeach ?>
