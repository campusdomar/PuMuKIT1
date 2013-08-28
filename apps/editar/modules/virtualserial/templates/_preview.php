<?php if( isset($mm) ):?>


<!-- --------------------------------- -->

<!-- DATE -->
<div style="background-color:#006699; color:#FFFFFF; font-weight:bold; margin-bottom:11px; text-align:center;">
  <?php echo $mm->getRecordDateText()?>
</div>

<!-- SUBSERIAL_TITLE-->
<?php if($mm->getSubserialTitle() !== ''):?>
  <div style="background-color:#006699; color:#FFFFFF; font-weight:bold; margin-bottom:11px; text-align:center;">
    <?php echo $mm->getSubserialTitle(); ?>
  </div>
<!-- PLACE-->
<?php elseif($mm->getPrecinctId() > 1): ?>
  <div style="background-color:#DFDFFF; color:#660000; font-weight:bold; margin-bottom:11px; padding-right:5px; text-align:right;">
    <?php echo $mm->getPlace()->getName()?>  
  </div>
<?php endif?>


<!-- PIC -->
<div id="serial_mm" class="serial_mm_<?php echo ($mm->getStatusId()?1:0)?>" style="background-color:transparent; height: 100%">

 <div style="background-color:transparent; margin: 3%; overflow: hidden;" VALIGN="MIDDLE" ALIGN="CENTER">
    <?php if($file): ?>
       <?php include_partial('player', array('file' => $file, 'w' => 360, 'h' => 280))?>
    <?php else: ?>
       <div class="SimPlayer">
          <img WIDTH="30" HEIGHT="30" src="/images/1.8/play.png" style="margin-top: 40px;"></img>
          <p class="SimPlayerText" style="background-color: black">El objeto multimedia seleccionado no posee un video reproducible</p>
       </div>
    <?php endif?>
 </div>

 <div style="padding: 0px 3% 8px">
  Pertenece a: <a href="<?php echo url_for("mms/index?serial=" . $mm->getSerialId())?>"><?php echo $mm->getSerial()->getTitle() ?></a>
 </div>

 <?php if($mm->getStatusId() == MmPeer::STATUS_NORMAL):?>
 <!-- TODO Ver si esta publicado..-->
   <div style="padding: 0px 3% 8px">
    <a target="_black" href="/video/index/id/<?php echo $mm->getId()?>">Ver en webTV</a>
   </div>
 <?php endif ?>

  <div style="padding: 0px 3%;">
    <div id="list_unesco" draggable="true" class="bs-docs-example">
       <?php foreach($mm->getCategorys($cat_raiz_unesco) as $unesco): ?>
          <div id="cat-<?php echo $unesco->getId()?>" class="label label-info unesco_element">
            <?php echo $unesco->getName() ?>
            <a href="#" class="unesco_element_a" onclick="if (window.confirm('¿Seguro?')) {$('cat-<?php echo $unesco->getId()?>').remove(); del_tree_cat(<?php echo $unesco->getId()?>, <?php echo $mm->getId()?>)};; return false;">X</a>
          </div>
       <?php endforeach ?>
    </div>
  </div> 
</div>
<!-- --------------------------------- -->


<?php else:?>
<p>
  Selecione algun objeto multimedia.
</p>
<?php endif?>


<?php echo javascript_tag("
function previewHandleDragOver(e) {
  e.preventDefault();
  //console.log('PREVIEW dragover');
  if (dragElement == 'tree') {
    this.classList.add('over');
  }
}

function previewHandleDragEnter(e) {
  //console.log('PREVIEW dragenter');
  if (dragElement == 'tree') {
    this.classList.add('over');
  }
}

function previewHandleDragLeave(e) {
  //console.log('PREVIEW dragleave');
  this.classList.remove('over');
}

function previewHandleDrop(e) {
  //console.log('PREVIEW drop');
  this.classList.remove('over');
  if (dragElement == 'tree') {
    //console.log('#########-> Drop tree con id: ', e.dataTransfer.getData('id'));
    add_tree_several_cat(e.dataTransfer.getData('id')," . $sf_user->getAttribute('id', null, 'tv_admin/virtualserial')  .", " . $cat_raiz_unesco->getId() . ");
    //add_tree_cat(dragSrcEl.children[0].id," . $sf_user->getAttribute('id', null, 'tv_admin/virtualserial')  .", " . $cat_raiz_unesco->getId() . ");
  }

}

var unescos = document.querySelectorAll('#list_unesco');
[].forEach.call(unescos, function(unesco) {
  unesco.addEventListener('dragstart', function(e) {e.preventDefault();}, false);
  unesco.addEventListener('dragover', previewHandleDragOver, false);
  unesco.addEventListener('dragenter', previewHandleDragEnter, false);
  unesco.addEventListener('dragleave', previewHandleDragLeave, false);
  unesco.addEventListener('drop', previewHandleDrop, false);
});
") ?>
