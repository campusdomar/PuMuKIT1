<div>
<h2 style="text-align:center"><?php echo $mm->getTitle()?></h2>
<h3 style="text-align:center"><?php echo $mm->getSubtitle()?></h3>

<p style="">
<span style="font-weight: bold; text-align: justify">DESCRIPCION:</span>
<?php echo ($mm->getDescription() == ""?"No Tiene":$mm->getDescription())?>
</p>





<div class="objects">
  <!-- FILES -->
          <?php $files = $mm->getFilesPublic() ?> 
          <?php foreach ($files as $file):?>  
            <div class="file <?php echo ($file->getAudio()?'audio':'video')?>">
               <?php echo link_to('Reproductor externo', 'video/index?id=' . $file->getId())?></a>
               <?php if ($file->getDescription() !== ""): ?>
                 &nbsp;|&nbsp;&nbsp;<strong><?php echo ( $file->getDescription() ) ?></strong>
               <?php endif ?>
               &nbsp;|&nbsp;&nbsp;<span class="language"><?php echo $file->getLanguage()->getName() ?></span>

               &nbsp;(<?php echo $file->getDurationString() ?>)
               &nbsp;|&nbsp;Visto: <span class="numView"><?php echo $file->getNumView()?></span><?php echo (($file->getNumView() == 1)?' vez':' veces')?>
            </div>
          <?php endforeach; ?>         

  
  <!-- MATERIAL -->
          <?php $materials = $mm->getMaterials() ?> 
    	  <?php foreach ($materials as $material): $material->setCulture( $sf_user->getCulture() ) ?>  
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