<?php if( isset($mm) ):?>


<!------------------------------------->

<!-- DATE (falta I18n)-->
<div style="background-color:#006699; color:#FFFFFF; font-weight:bold; margin-bottom:11px; text-align:center;">
  <?php echo $mm->getRecordDate('%d de %B de %Y')?>
</div>

<!-- SUBSERIAL_TITLE-->
<?php if($mm->getSubserialTitle() !== ''):?>
  <div style="background-color:#006699; color:#FFFFFF; font-weight:bold; margin-bottom:11px; text-align:center;">
    <?php echo $mm->getSubserialTitle(); ?>
  </div>
<!-- PALCE-->
<?php elseif($mm->getPrecinctId() > 1): ?>
  <div style="background-color:#DFDFFF; color:#660000; font-weight:bold; margin-bottom:11px; padding-right:5px; text-align:right;">
    <?php echo $mm->getPlace()->getName()?>  
  </div>
<?php endif?>


<!-- PIC -->
<div id="serial_mm" class="serial_mm_<?php echo ($mm->getStatusId()?1:0)?>" style="background-color:transparent">
  <table>
   <tbody>
    <tr>
     <td width="1%" valign="top"  style="background-color:transparent"> <!-- hack-->
       <?php $pics = $mm->getUrlPics(false, 3) ?>
       <div id="serial_mm_pics"> 
         <?php foreach ($pics as $value): ?><img style="border:1px solid #000000; height:82px; width:100px;" src="<?php echo $value ?>" class="serial"><?php endforeach; ?>
        </div>
        
     </td>
     <td style="background-color:transparent">
       <div id="serial_mm_info" style="background-color:transparent; padding-left:2%; padding-right:2%; text-align:left; width:95%; ">
  
  <!-- TITLE & SUBTITLE -->
  
        <?php if ($mm->getTitle() !== ''):?>
          <div id="title" style="font-size:13px; font-weight:bold">"<?php echo $mm->getTitle()?>"</div>
        <?php endif ?>
        <?php if ($mm->getSubtitle() !== ''):?>
          <div id="subtitle" style="color:#660000;"><?php echo $mm->getSubtitle()?></div>	
        <?php endif ?>
  
        <div id="objects">
  <!-- FILES -->
          <?php $files = $mm->getFiles() ?> 
          <?php foreach ($files as $file): if(!$file->getPerfil()->getDisplay()) continue;?>  
            <div id="file" class="<?php echo ($file->getAudio()?'audio':'mm')?>">
               <a title="reproducir" href="#" onclick=" Shadowbox.open({
                  title:      'Vista Previa',
                  content:    '<?php echo $file->getUrl()?>',
                  type:       'wmp',
                  height:     <?php echo $file->getPerfil()->getResolutionVer()?>,
                  width:      <?php echo $file->getPerfil()->getResolutionHor()?>
                 }); return false;">
                 <?php echo $file->getAudio()?'Audio':'V&iacute;deo'?>
               </a>
               <?php if ($file->getDescription() !== ""): ?>
                 &nbsp;|&nbsp;&nbsp;<strong><?php echo ( $file->getDescription() ) ?></strong>
               <?php endif ?>
               &nbsp;|&nbsp;&nbsp;<span id="language"><?php echo $file->getLanguage()->getName() ?></span>

               &nbsp;(<?php echo $file->getDurationString() ?>)
               &nbsp;|&nbsp;Visto: <span id="numView"><?php echo $file->getNumView()?></span><?php echo (($file->getNumView() == 1)?' vez':' veces')?>
               <?php //include_partial('global/voteMm', array('file' => $file)) ?></span>
            </div>

          <?php endforeach; ?>         

  
  <!-- MATERIAL -->
          <?php $materials = $mm->getMaterials() ?> 
    	  <?php foreach ($materials as $material): ?>  
            <div id="material" class="<?php echo $material->getMatType()->getType() ?>">
              <a href="<?php echo $material->getUrl() ?>"><?php echo $material->getName() ?></a>
            </div>
          <?php endforeach; ?>
  
  <!-- LINK -->
          <?php $links = $mm->getLinks() ?> 
          <?php foreach ($links as $link): ?>  
            <div id="link" class="link">
              <?php echo link_to($link->getName(), $link->getUrl(), array('target' => '_blank') ) ?>
            </div>
          <?php endforeach; ?>
        </div>
        <br />
        
  <!-- PERSONS PRESENT -->
        <?php foreach($roles as $role): if($role->getDisplay() == true): ?>
	  <?php $acts = $mm->getPersons($role->getId()) ?>
	  <?php foreach ($acts as $act): ?>
            <div>
              <div class="person" style="color:#000099; font-weight:bold;">
	        <?php echo $role->getText()?>
	        <?php if ($act->getWeb() != ''): ?>
	          <a href="<?php echo $act->getWeb()?>"><?php echo $act->getHName()?> </a>
          	<?php else: ?>
                  <?php echo $act->getHName()?>
                <?php endif ?>
              </div>
              <?php echo $act->getInfo()?>
            </div>
          <?php endforeach; ?>
        <?php endif; endforeach; ?>
  

       </div>
     </td>
   </tr>
  </tbody>
 </table>
</div>
<!------------------------------------->



<?php else:?>
<p>
  Selecione algun objeto multimedia.
</p>
<?php endif?>  