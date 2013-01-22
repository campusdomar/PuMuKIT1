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


$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
$mail->addReplyTo(sfConfig::get('app_info_mail'));

$mail->addAddress(sfConfig::get('app_info_mail'));
$mail->addAddress('rubenrua@uvigo.es');

$mail->setSubject('Mensajes PuMuKIT (Horario)');
$mail->setBody('
Prueba
--
'.date().'
');

//$mail->send();
