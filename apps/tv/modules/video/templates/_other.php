<div class="other_mmobjs">
  <div class="label">
    <?php echo $texto ?>
  </div>

  <div class="box">
    <?php if(count($mmobjs) == 0):?>
      <?php echo __('No existen vídeos de estas características')?>.
    <?php else:?>
      <?php include_partial('global/mini_mmobj', array('mmobjs' => $mmobjs))?>    
    <?php endif?>
  </div>

</div>