<!-- PIC -->
<div class="serial_mm_info">
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

  <!-- PERSONS ACT -->
        <div class="persons" style="overflow: hidden">
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
</div>


