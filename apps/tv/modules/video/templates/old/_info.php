<div style="overflow:hidden; text-align: right">
  <div style="float:left">
    <img src="<?php echo $mm->getFirstUrlPic() ?>" style="width: 60px"/>
  </div>
  
  <div style="padding-left: 51px">
    <a href="http://www.facebook.com/sharer.php?u=<?php echo url_for('new_serial/index?id=1', true)?>/&t=<?php echo urlencode($mm->getTitle())?>">
      <img style="width:20px" src="/images/tv/iconos/facebook.jpg" title="<?php echo __("Compartir en facebook")?>" />
    </a>
    <a href="http://twitter.com/home?status=<?php echo urlencode($mm->getTitle())?> <?php echo url_for('new_serial/index?id=1', true)?>">
      <img style="width:20px" src="/images/tv/iconos/twitter.jpg" title="<?php echo __("Compartir en twitter")?>" />     
    </a>
  </div>
  
  <div style="padding-left: 51px">   
    <input type="text" value="<?php echo url_for('video/index?id=2', true) ?>" onclick="this.select()" style="width: 66%; border: 1px solid #ccc" readonly="readonly"/>
  </div>
</div>

<br />

<div style="font-weight: bold; color: blue; text-align: center">
  <?php echo $mm->getRecorddate('d/m/y')?>
</div>


<h4 style="font-size: 115%">
  <?php echo $mm->getTitle()?>
</h4>

<div>
  <?php echo $mm->getSubTitle()?>
</div>

<div>
  <?php if(strlen($mm->getDescription()) < 60):?>
    <?php echo $mm->getDescription() ?>
  <?php else:?>
    <span id="description_mm_<?php echo $mm->getId()?>_mini" class="description_mm_<?php echo $mm->getId()?>" title="<?php echo $mm->getDescription()?>">
      <?php echo substr($mm->getDescription(),0,60) ?>
      <a href="#" 
         onclick="$('description_mm_<?php echo $mm->getId()?>_mini').hide();$('description_mm_<?php echo $mm->getId()?>_all').show(); return false" 
         style="color:blue">(...)</a>
    </span>
    <span id="description_mm_<?php echo $mm->getId()?>_all" class="description_mm_<?php echo $mm->getId()?>" style="display:none">
      <?php echo $mm->getDescription() ?>
      <a href="#" 
         onclick="$('description_mm_<?php echo $mm->getId()?>_mini').show();$('description_mm_<?php echo $mm->getId()?>_all').hide(); return false" 
         style="color:blue">(-)</a>
    </span>
  <?php endif?>
</div>



<?php $files = $mm->getFilesPublic() ?> 
<?php foreach ($files as $file):?>  
  <div class="file <?php echo ($file->getAudio()?'audio':'video')?>">
     <?php //echo link_to($file->getAudio()?'Audio':'V&iacute;deo', 'video/index?id=' . $mm->getId())?>
     <?php echo link_to($file->getPerfil()->getLink(), 'video/index?id=' . $mm->getId())?>
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







<br />
<br />
<br />

<a href="<?php echo url_for('serial/index?id=' . $mm->getSerialId())?>"
   style="padding: 5px; font-weight: bold; color: blue;">
  ← Volver a la serie        
</a>


