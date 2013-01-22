<?php if( isset($mm) ): ?>
  
  <!-- actualizar vistaPrevia -->
  <ul id="menuTab">
    <li id="pubMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('pubMm'); update_file.stop(); return false;" >Publicacion</a>
    </li>
    <li id="metaMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('metaMm'); update_file.stop(); return false;" >Metadatos</a>
    </li>
    <li id="groundMm" class="noSel" >
      <a href="#" onclick="menuTab.select('groundMm'); update_file.stop(); return false;" >Areas de conocimento</a>
    </li>
    <li id="personMm" class="noSel" >
      <a href="#" onclick="menuTab.select('personMm'); update_file.stop(); return false;" >Personas</a>
    </li>
    <li id="mediaMm"  class="noSel" >
      <a href="#" onclick="menuTab.select('mediaMm'); update_file.start(); return false;" >Multimedia</a>
    </li>
  </ul>
  
  <div class="background_id">
    <?php echo $mm->getId() ?>
  </div>
  
  <div id="pubMmDiv"  style="display:none;">
    <?php include_partial('edit_pub', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>  

  <div id="metaMmDiv"  style="display:none;">
    <?php include_partial('edit_meta', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <div id="groundMmDiv"  style="display:none;">
    <?php include_partial('edit_ground', array('mm' => $mm, 'langs' => $langs, 'grounds' => $grounds , 'grounds_sel' => $grounds_sel, 'groundtypes' => $groundtypes)) ?>
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

