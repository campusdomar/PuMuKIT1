<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
  <responseDate><?php echo date('Y-m-d\TH:i:s\Z')?></responseDate>
  <request><?php echo url_for('oai/index', true)?></request>
  <error code="<?php echo $cod ?>"><?php echo $msg ?></error>
</OAI-PMH>
