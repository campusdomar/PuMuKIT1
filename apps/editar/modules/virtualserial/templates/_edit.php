<?php if( isset($mm) ): ?>
<div>
  <!-- actualizar vistaPrevia -->
  <ul id="menuTab_virtual" style="border-bottom: 1px solid rgb(105, 151, 167);overflow: hidden;">
    <li id="pubMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('pubMm'); update_file.stop(); return false;" >Publicacion</a>
    </li>
    <li id="metaMm"   class="noSel" >
      <a href="#" onclick="menuTab.select('metaMm'); update_file.stop(); return false;" >Metadatos</a>
    </li>
    <li id="categoryMm" class="noSel" >
      <a href="#" onclick="menuTab.select('categoryMm'); update_file.stop(); return false;" >Categorias</a>
    </li>
    <li id="personMm" class="noSel" >
      <a href="#" onclick="menuTab.select('personMm'); update_file.stop(); return false;" >Personas</a>
    </li>
    <li id="mediaMm"  class="noSel" >
      <a href="#" onclick="menuTab.select('mediaMm'); update_file.start(); return false;" >Multimedia</a>
    </li>
       <?php $title = $mm->getTitle(); while(strlen($title)>67): ?>
          <?php $title = substr($title, 0, strrpos($title, ' '));?>
       <?php endwhile?>
       <li style="font-weight: bold; font-size: 13px; padding-left: 10%"><abbr title="<?php echo $mm->getTitle()?>"><?php echo $mm->getId()?>  -  <?php echo ($mm->getTitle()>$title)? $title.' ...' : $mm->getTitle()?></abbr></li>
  </ul>
</div>
  <div id="pubMmDiv" class="virtual_edit" style="display:none;">
    <?php include_partial('edit_pub', array('mm' => $mm, 'langs' => $langs, 
                                            'timeframe1' => $timeframe1,
                                            'interval1cmp' => $interval1cmp,
                                            'timeframe2' => $timeframe2,
                                            'interval2cmp' => $interval2cmp)) ?>
  </div>  

  <div id="metaMmDiv" class="virtual_edit"  style="display:none;">
    <?php include_partial('edit_meta', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <div id="categoryMmDiv" class="virtual_edit"  style="display:none;">
    <?php include_partial('edit_category', array('mm' => $mm, 'langs' => $langs)) ?>
  </div>
  
  <div id="personMmDiv" class="virtual_edit" style="display:none;">
    <?php include_partial('edit_person', array('mm' => $mm, 'langs' => $langs, 'roles' => $roles)) ?>
  </div>
  
  <div id="mediaMmDiv" class="virtual_edit" style="display:none;">
     <?php include_partial('edit_media', array('mm' => $mm, 'langs' => $langs, 'roles' => $roles, 'module' => $module)) ?>
  </div>
  <?php echo javascript_tag("
    //alert('Tengo ('+document.location.hash+') y ('+(['#metaMmHash', '#groundMmHash', '#personMmHash', '#mediaMmHash'].indexOf(document.location.hash))+')');
    var menuTab = new menuTabClass(document.location.hash);
  ") ?>
<?php endif?>
