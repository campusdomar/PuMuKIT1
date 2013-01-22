<?php
/**
 * pr batch script
 *
 * Here goes a brief description of the purpose of the batch script
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

$text_log = "";
//echo "START";



$mms = MmPeer::masVistos('es', 30, 10);

foreach($mms as $mm){
  $text_log .= " - " . $mm->getSerialId() . "/" . $mm->getId() . ", S:" .$mm->getSerial()->getTitle() . ", V:" .$mm->getTitle() . "\n";
}

$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->addReplyTo(sfConfig::get('app_info_mail'));

$mail->addAddress(sfConfig::get('app_info_mail'));
$mail->addAddress('rubenrua@uvigo.es');
$mail->addAddress('vgoya@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (mensual)');
$mail->setBody('
Asuntos:
 - Recorderse de cambiar "Mas Vistos"
--
'.date().' 
'. $text_log );

$mail->send();

