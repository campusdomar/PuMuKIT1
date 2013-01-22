<?php 
$antes2 = array("&lt;strong&gt;", "&lt;/strong&gt;"); 
$despues2 = array("<strong>", "</strong>");
$line2 = str_replace($antes2, $despues2, $object->getLine2Rich());


$antes = array('%title%', '%line2%', '%date%', '%number%', '%url%', '%img1%', '%img2%', '%img3%');
$despues = array($sf_data->getRaw('object')->getTitle(), $line2, $object->getPublicDate('d/m/Y'), $object->getNumber(),  sfConfig::get('app_info_link'). '/serial/index/id/' . $object->getSerialId(), $img1, $img2, $img3);

$mail_text = str_replace($antes, $despues, TemplatePeer::getText('email_HTML', $object->getCulture()));

$culture_old = $object->getCulture();
$langs = sfConfig::get('app_lang_array', array('es'));
foreach($langs as $lang){
  $object->setCulture($lang);
  $antes = array('%title[' . $lang . ']%', '%line2[' . $lang . ']%', '%date[' . $lang . ']%', '%number[' . $lang . ']%');
  $despues = array($sf_data->getRaw('object')->getTitle(), $line2, $object->getPublicDate('d/m/Y'), $object->getNumber());
  
  $mail_text = str_replace($antes, $despues, $mail_text);
}
$object->setCulture($culture_old);

echo $mail_text;
?>
