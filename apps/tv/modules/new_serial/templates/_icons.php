<!-- FILES -->
<?php $files = $mm->getFilesPublic() ?> 
<?php foreach ($files as $file):?>  
  <img src="/images/tv/iconos/<?php echo ($file->getAudio()?'altavoz2.gif':'movie2.gif') ?>" />
<?php endforeach; ?>         

  
<!-- MATERIAL -->
<?php $materials = $mm->getMaterials() ?> 
<?php foreach ($materials as $material): ?>  
  <img src="/images/tv/iconos/<?php echo $material->getMatType()->getType() ?>.gif" />
<?php endforeach; ?>
  
  <!-- LINK -->
<?php $links = $mm->getLinks() ?> 
<?php foreach ($links as $link): $link->setCulture( $sf_user->getCulture() ) ?>  
  <img src="/images/tv/iconos/url.gif" />
<?php endforeach; ?>
