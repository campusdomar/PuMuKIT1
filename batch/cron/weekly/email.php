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

$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->addReplyTo(sfConfig::get('app_info_mail'));

$mail->addAddress(sfConfig::get('app_info_mail'));
$mail->addAddress('rubenrua@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (semanal)');
$mail->setBody('
Prueba SEMANAL
'.date().'
');

//$mail->send();

//#######################################################
//#######################################################
//#######################################################

$c = new Criteria();
$c->add(MmPeer::PUBLICDATE, date("Y-m-d", time() - (7 * 24 * 60 * 60)), Criteria::GREATER_EQUAL);
$c->addAscendingOrderByColumn(MmPeer::SERIAL_ID);
$c->addAscendingOrderByColumn(MmPeer::RANK);
$mms = MmPeer::doSelectWithI18n($c, 'es');

$text_log .= "Informacion de los objetos multimedia grabados esta semana.\n\n";

$serial_old = null; 
foreach($mms as $mm){
  if($serial_old != $mm->getSerialId()){
    $text_log .= "|--------------------------------------------\n";
    $text_log .= "|-- SERIE:" . $mm->getSerial()->getId() . ' - ' . $mm->getSerial()->getTitle() . 
      '('.$mm->getSerial()->getPublicDate('d/m/Y') . ")\n";
  }
  $text_log .= "|   |-- OBJMM:" . $mm->getId() . ' - ' . $mm->getTitle() . ' ('.$mm->getPublicDate('d/m/Y') . ")\n";
  $files = $mm->getFiles();
  
  foreach($files as $file){
    $text_log .= "|   |   |-- FILES:" . $file->getId() . ' - ' . $file->getFile() . ' ('.$file->getDurationString() . ")\n";
  }
  
  $serial_old = $mm->getSerialId();
  
}

$text_log .= "\n\n\nTareas ejecutadas Correctamente:\n\n";

$c = new Criteria();
$c->add(TranscodingPeer::TIMEEND, date("Y-m-d", time() - (7 * 24 * 60 * 60)), Criteria::GREATER_EQUAL);
$c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_FINALIZADO);
$c->addAscendingOrderByColumn(TranscodingPeer::TIMEEND);
$trans = TranscodingPeer::doSelectWithI18n($c, 'es');
foreach($trans as $t){
  $text_log .= "TR:" .$t->getId() ." - ". $t->getMm()->getTitle()."(".$t->getPerfil()->getName().")\n";
}


$text_log .= "\n\n\nTareas ejecutadas Erroneamente:\n\n";

$c = new Criteria();
$c->add(TranscodingPeer::TIMEEND, date("Y-m-d", time() - (7 * 24 * 60 * 60)), Criteria::GREATER_EQUAL);
$c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_ERROR);
$c->addAscendingOrderByColumn(TranscodingPeer::TIMEEND);
$trans = TranscodingPeer::doSelectWithI18n($c, 'es');
foreach($trans as $t){
  $text_log .= "TR:" .$t->getId() ." - ". $t->getMm()->getTitle()."(".$t->getPerfil()->getName().")\n";
}


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
$mail->addAddress('luispena@uvigo.es');
//$mail->addAddress('vgoya@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (semanal)');
$mail->setBody($text_log);

$mail->send();
