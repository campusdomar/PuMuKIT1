<?php echo '<?xml version="1.0" encoding="UTF-8"?> ' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request verb="GetRecord" identifier="<?php echo $sf_request->getParameter('identifier')?>"
     metadataPrefix="oai_dc"><?php echo url_for('oai/index', true)?></request>
  <GetRecord>
    <?php include_partial('oai/record', array('mm' => $mm))?>
  </GetRecord>
</OAI-PMH>