<a name="<?php echo $mm->getId() ?>"></a>

<!-- SUBSERIAL -->
<?php if (!($mm->getSubserial())): ?>
  <div class="inter_mm"></div>
<?php endif; ?>


<!-- DATE -->
<?php if(($template == 2) || ((!in_array($template, array(4,5))) && ($mm->getRecordDate()) && ($mm->getRecorddate() !== '1999-11-30') && ($mm->getRecordDate('dmy') !== $lastDate))): ?>
  <div class="serial_date">
    <?php echo $mm->getRecorddateText(); ?>
  </div>
<?php endif; ?>
   
<!-- SUBSERIAL -->
<?php if((($template == 3) &&((htmlentities($mm->getSubserialTitle()) !== $lastSubserialTitle)||($mm->getRecorddate('dmy') !== $lastDate))) || 
	 (($template == 4) &&(htmlentities($mm->getSubserialTitle()) !== $lastSubserialTitle))):?>
  <div class="serial_date">
    <?php echo $mm->getSubserialTitle(); ?>
  </div>
<?php endif; ?>


<!-- MULTISUBSERIAL -->
<?php if($template == 5): $subserial_ahora = explode("\\n", $mm->getSubserialTitle()); $subserial_antes = explode("\\n", $lastSubserialTitle)?>
  <?php $subserial_todos = false; foreach($subserial_ahora as $subserial_level => $subserial_text):?>
  <?php if($subserial_todos || (count($subserial_antes) <= $subserial_level) || (htmlentities($subserial_text) != $subserial_antes[$subserial_level])): $subserial_todos = true ?>
      <div class="serial_date">
        <?php echo $subserial_text; ?>
      </div>
    <?php endif ?>
  <?php endforeach ?>
<?php endif ?>


<!-- PIC -->
<div class="serial_mm">
  <table>
   <tbody>
    <tr>
     <td width="1%" valign="top"> <!-- hack-->
       <?php $pics = $mm->getUrlPics() ?>
       <div class="serial_mm_pics"> 
         <?php foreach ($pics as $value): ?>
           <a href="<?php echo url_for('video/index?id=' . $mm->getId())?>" >
             <img src="<?php echo $value ?>" class="serial">
           </a>
         <?php endforeach; ?>
       </div>                
     </td>
     <td>
       <div class="serial_mm_info">
  
  <!-- TITLE & SUBTITLE -->
  
        <?php if ($mm->getTitle() !== ''):?>
          <div class="title">"<?php echo $mm->getTitle()?>"</div>
        <?php endif ?>
        <?php if ($mm->getSubtitle() !== ''):?>
          <div class="subtitle"><?php echo $mm->getSubtitle()?></div>	
        <?php endif ?>
  
        <div class="objects">
  <!-- FILES -->
          <?php $files = $mm->getFilesPublic(); $num_files = count($files) ?> 
          <?php foreach ($files as $file):?>  
            <div class="file <?php echo ($file->getAudio()?'audio':'video')?>">
               <?php echo link_to($file->getPerfil()->getLink(), ($num_files==1)?'video/index?id=' . $mm->getId():'video/index?file_id=' . $file->getId())?>
               <?php if ($file->getDescription() !== ""): ?>
                 &nbsp;|&nbsp;&nbsp;<strong><?php echo ( $file->getDescription() ) ?></strong>
               <?php endif ?>
               &nbsp;|&nbsp;&nbsp;<span class="language"><?php echo $file->getLanguage()->getName() ?></span>

               &nbsp;(<?php echo $file->getDurationString() ?>)
               &nbsp;|&nbsp;Visto: <span class="numView"><?php echo $file->getNumView()?></span><?php echo (($file->getNumView() == 1)?' vez':' veces')?>
            </div>
          <?php endforeach; ?>   

  <!-- MATTERHORN -->
          <?php if($mh = MmMatterhornPeer::retrieveByPK($mm->getId())): ?>
          <div id="material" class="file matterhorn">
            <a href="<?php echo url_for('video/index?id=' . $mm->getId())?>">Video-MH<?php echo ($mm->getBroadcast()->getBroadcastType() == "pub")?"":" privado"?></a>
        &nbsp;|&nbsp;&nbsp;<span class="language"><?php echo $mh->getLanguage()->getName() ?></span> 
        &nbsp;|&nbsp; <?php echo $mh->getDurationString() ?>
        &nbsp;|&nbsp; <?php echo __('Visto:') ?> <span class="numView"><?php echo $mh->getNumView()?></span><?php echo (($mh->getNumView() == 1)? __(' vez') : __(' veces'))?>
          </div>
          <?php endif ?>      
  
  <!-- MATERIAL -->
          <?php $materials = $mm->getMaterials() ?> 
    	  <?php foreach ($materials as $material): if(!$material->getDisplay()) continue;$material->setCulture( $sf_user->getCulture() ) ?>  
            <div id="material" class="<?php echo $material->getMatType()->getType() ?>">
              <a href="<?php echo $material->getUrl() ?>"><?php echo $material->getName() ?></a>
            </div>
          <?php endforeach; ?>
  
  <!-- LINK -->
          <?php $links = $mm->getLinks() ?> 
          <?php foreach ($links as $link): $link->setCulture( $sf_user->getCulture() ) ?>  
            <div id="link" class="link">
              <?php echo link_to($link->getName(), $link->getUrl(), array('target' => '_blank') ) ?>
            </div>
          <?php endforeach; ?>
        </div>
        <br />
        
  <!-- PERSONS ACT -->
        <?php foreach($roles as $role): if($role->getDisplay() == true): ?>
          <?php $acts = $mm->getPersons($role->getId()) ?> 
          <?php foreach ($acts as $act): ?>
            <div>
              <div class="person">
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


