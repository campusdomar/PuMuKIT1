
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request verb="Identify"><?php echo url_for('oai/index', true)?></request>
  <Identify>
    <repositoryName><?php echo sfConfig::get('app_info_description') ?></repositoryName>
    <baseURL><?php echo url_for('oai/index', true) ?></baseURL>
    <protocolVersion>2.0</protocolVersion>
    <adminEmail><?php echo sfConfig::get('app_info_mail') ?></adminEmail>
    <earliestDatestamp>1990-02-01T12:00:00Z</earliestDatestamp>
    <deletedRecord>no</deletedRecord>
    <granularity>YYYY-MM-DDThh:mm:ssZ</granularity>
  </Identify>
</OAI-PMH>
