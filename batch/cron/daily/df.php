<?php

/**
 * df batch script
 *
 * Comprueba diariamente que el disco duro no esta ocupado mas de 95%
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->addReplyTo(sfConfig::get('app_info_mail'));

$mail->addAddress(sfConfig::get('app_info_mail'));
$mail->addAddress('rubenrua@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (Diario)');
$mail->setBody('
Prueba 
--
'.date().'
');

//$mail->send();

$mounts = sfConfig::get('app_transcoder_path_unix');
$return = array();
$text_log = "";

foreach($mounts as $mount){
  $total = disk_total_space($mount);
  $free = disk_free_space($mount);
  $a = array($mount, sprintf('%.2f', ($total/1073741824)), sprintf('%.2f', ($free/1073741824)));
  if ($free < (0.05 * $total)){
    $return[] = $a;
  }
}


if(count($return) == 0){
  exit;
}

$text_log .= "\n\nAVISO!!\nDisco Duro LLeno:\n\n";

foreach($return as $di){
  $text_log .= "HD:" . $di[0] . " - " . $di[2] . "/" . $di[1] . "\n";
}


$text_log .= "\n\n\n\n";

//
$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->addReplyTo(sfConfig::get('app_info_mail'));

$mail->addAddress(sfConfig::get('app_info_mail'));
$mail->addAddress('rubenrua@uvigo.es');
//$mail->addAddress('luispena@uvigo.es');
//$mail->addAddress('vgoya@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT - Aviso HD Lleno');
$mail->setBody($text_log);

$mail->send();

