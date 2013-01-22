<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request verb="ListSets"><?php echo url_for('oai/index', true)?></request>
 <ListSets>
 <?php foreach($channels as $ch):?>
  <set>
    <setSpec><?php echo $ch->getId()?></setSpec>
    <setName><?php echo $ch->getName()?></setName>
  </set>
   <?php foreach($serials[$ch->getId()] as $serial):?>
  <set>
    <setSpec><?php echo $ch->getId()?>:(<?php echo $serial->getId()?>)</setSpec>
    <setName><?php echo $serial->getTitle()?></setName>
  </set>   
   <?php endforeach; ?>
 <?php endforeach;?>
 </ListSets>
</OAI-PMH>