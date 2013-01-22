<?php

/**
 * profile batch script
 *
 * Script que muestra las urls y resoluciones reales y alamacenadas
 * de todos los archivos de video catalogados en la base de datos.
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
echo "START\n\n\n";

$mail = new sfMail();
$mail->initialize();
$mail->setMailer('sendmail');
$mail->setCharset('utf-8');

$mail->setSender('tv@uvigo.es', 'uvigoTv');
$mail->setFrom('tv@uvigo.es', 'uvigoTv');
$mail->addReplyTo('tv@uvigo.es');
  
$mail->addAddress('rubenrua@uvigo.es');


$mail->setSubject('Email de prueba');
$mail->setBody('
EMAIL DE PRUEBA.
');

var_dump($mail->send());

