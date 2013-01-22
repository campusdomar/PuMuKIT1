  <br />
  <?php foreach($cpus as $cpu): ?>
  <div style="text-align:center; color: rgb(0, 0, 0);">
    <span style="font-weight: bold">IP:&nbsp;</span>
    <span style="color: rgb(0, 0, 0);"><?php echo $cpu->getIp()?></span>
    <span style="font-weight: bold">&nbsp;--&nbsp;N&#186; m&aacute;x. proc. permitidos:&nbsp;</span>
    <span style="color: rgb(0, 0, 0);"><?php echo $cpu->getNumber()?></span>
    <span>
      <?php
        if ($cpu->getNumber() < $cpu->getMax()){ 
          echo link_to_remote(image_tag('admin/transcoder/subir.png', 'alt=subir title=subir'), array('update' => 'cpus_transcoders', 'url' => 'transcoders/cpusup?id='.$cpu->getId(), 'script' => 'true'));
        }
        else echo image_tag('admin/transcoder/subir_off.png', 'alt=subir title=subir');
      ?>
    </span>
    <span>
      <?php
        if ($cpu->getNumber() > $cpu->getMin()){ 
          echo link_to_remote(image_tag('admin/transcoder/bajar.png', 'alt=bajar title=bajar'), array('update' => 'cpus_transcoders', 'url' => 'transcoders/cpusdown?id='.$cpu->getId(), 'script' => 'true'));
        }
        else echo image_tag('admin/transcoder/bajar_off.png', 'alt=bajar title=bajar');
      ?>
    </span>
  </div> 
  <br />
  <?php endforeach ?>
