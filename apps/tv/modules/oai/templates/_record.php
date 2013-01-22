<record> 
  <?php include_partial('oai/header', array('mm' => $mm))?>
  <metadata>
    <oai_dc:dc 
       xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" 
       xmlns:dc="http://purl.org/dc/elements/1.1/" 
       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
       xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ 
       http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
      <dc:title><?php echo $mm->getTitle()?></dc:title> 
      <dc:description><?php echo $mm->getDescription() ?></dc:description>     
      <dc:date><?php echo $mm->getPublicDate('Y-m-d')?></dc:date>
      <dc:identifier xsi:type="dcterms:URI" id="uid"><?php echo url_for('video/index?id='.$mm->getId() , true) ?></dc:identifier>
      <dc:type>Moving Image</dc:type>
      <dc:format>video/x-ms-wmv</dc:format>
      <dc:creator><?php echo sfConfig::get('app_info_mail')?></dc:creator>
      <dc:publisher><?php echo sfConfig::get('app_info_mail')?></dc:publisher>
      <dc:language>es</dc:language>
      <dc:rights><?php echo sfConfig::get('app_info_copyright')?></dc:rights>
    </oai_dc:dc>
  </metadata>
</record>
