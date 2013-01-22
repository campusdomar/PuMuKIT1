<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request verb="ListRecords"
           <?php if($sf_params->has('set')) echo 'set="'.$sf_request->getParameter('set').'" '?>
           <?php if($sf_params->has('from')) echo 'from="'.$sf_request->getParameter('from').'" '?>
           <?php if($sf_params->has('until')) echo 'until="'.$sf_request->getParameter('until').'" '?>
           metadataPrefix="oai_dc"><?php echo url_for('oai/index', true)?></request>
  <ListRecords>
  <?php foreach($mms as $mm):?>
    <?php include_partial('oai/record', array('mm' => $mm))?>
  <?php endforeach;?>
  </ListRecords>
</OAI-PMH>
