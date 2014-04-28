<?php if( isset($mm) ): ?>
  
  <!-- actualizar vistaPrevia -->
  <ul id="menuTab">
    <li id="pubMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('pubMm'); update_file.stop(); return false;" ><?php echo __('Publicación')?></a>
    </li>
    <li id="metaMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('metaMm'); update_file.stop(); return false;" ><?php echo __('Metadatos')?></a>
    </li>
    <li id="categoryMm" class="noSel" >
      <a href="#" onclick="menuTab.select('categoryMm'); update_file.stop(); return false;" ><?php echo __('Categorias')?></a>
    </li>
    <li id="personMm" class="noSel" >
      <a href="#" onclick="menuTab.select('personMm'); update_file.stop(); return false;" ><?php echo __('Personas')?></a>
    </li>
    <li id="mediaMm"  class="noSel" >
      <a href="#" onclick="menuTab.select('mediaMm'); update_file.start(); return false;" ><?php echo __('Multimedia')?></a>
    </li>
  </ul>
  
  <div class="background_id">
    <?php echo $mm->getId() ?>
  </div>
  
  <div id="pubMmDiv"  style="display:none;">
    <?php include_partial('edit_pub', array('mm' => $mm, 'langs' => $langs, 
                                            'timeframe1' => $timeframe1,
                                            'interval1cmp' => $interval1cmp,
                                            'timeframe2' => $timeframe2,
                                            'interval2cmp' => $interval2cmp)) ?>
  </div>  

  <div id="metaMmDiv"  style="display:none;">
    <?php include_partial('edit_meta', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <div id="categoryMmDiv" class="virtual_edit"  style="display:none;">
    <?php include_partial('edit_category', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <div id="personMmDiv" style="display:none;">
    <?php include_partial('edit_person', array('mm' => $mm, 'langs' => $langs, 'roles' => $roles)) ?>
  </div>
  
  <div id="mediaMmDiv" style="display:none;">
    <?php include_partial('edit_media', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <?php echo javascript_tag("
    //alert('Tengo ('+document.location.hash+') y ('+(['#metaMmHash', '#groundMmHash', '#personMmHash', '#mediaMmHash'].indexOf(document.location.hash))+')');
    var menuTab = new menuTabClass(document.location.hash);
  ") ?>
    
<?php endif?>

