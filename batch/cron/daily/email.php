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


$text_log .= "\n\n\nTareas ejecutadas Erroneamente:\n\n";

$c = new Criteria();
$c->add(TranscodingPeer::TIMEEND, date("Y-m-d", time() - (1 * 24 * 60 * 60)), Criteria::GREATER_EQUAL);
$c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_ERROR);
$c->addAscendingOrderByColumn(TranscodingPeer::TIMEEND);
$trans = TranscodingPeer::doSelectWithI18n($c, 'es');

if (count($trans) == 0) {
  exit;
}


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
//$mail->addAddress('luispena@uvigo.es');
//$mail->addAddress('vgoya@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (diario)');
$mail->setBody($text_log);

$mail->send();

