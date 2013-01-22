<?php 
$antes = array('%title%', '%url%');
$despues = array($sf_data->getRaw('object')->getTitle(), sfConfig::get('app_info_link'). '/serial/index/id/' . $object->getSerialId());

$mail_text = str_replace($antes, $despues, TemplatePeer::getText('email_TXT', $object->getCulture()));

$culture_old = $object->getCulture();
$langs = sfConfig::get('app_lang_array', array('es'));
foreach($langs as $lang){
  $object->setCulture($lang);
  $antes = array('%title[' . $lang . ']%');
  $despues = array($sf_data->getRaw('object')->getTitle());
  
  $mail_text = str_replace($antes, $despues, $mail_text);
}
$object->setCulture($culture_old);

echo $mail_text;
?>
