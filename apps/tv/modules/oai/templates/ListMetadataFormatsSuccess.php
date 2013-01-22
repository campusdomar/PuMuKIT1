<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">

  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request verb="ListMetadataFormats" 
        <?php if($sf_params->has('identifier')) echo 'identifier="'.$sf_request->getParameter('identifier').'" '?> >
        <?php echo url_for('oai/index', true)?></request>
  <ListMetadataFormats>
   <metadataFormat>
    <metadataPrefix>oai_dc</metadataPrefix>
    <schema>http://www.openarchives.org/OAI/2.0/oai_dc.xsd</schema>
    <metadataNamespace>http://www.openarchives.org/OAI/2.0/oai_dc/</metadataNamespace>
   </metadataFormat>
  </ListMetadataFormats>
</OAI-PMH>
