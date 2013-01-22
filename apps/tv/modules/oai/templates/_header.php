<header>
  <identifier>oai:<?php echo sfConfig::get('app_info_copyright')?>/<?php echo $mm->getId()?></identifier>
  <datestamp><?php echo $mm->getPublicDate('Y-m-d')?></datestamp>
  <setSpec><?php echo $mm->getSerial()->getSerialTypeId()?>:(<?php echo $mm->getSerialId()?>)</setSpec>
</header>