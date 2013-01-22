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
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
echo "START\n\n\n";



$c = new Criteria();
$c->add(SerialPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
$serials = SerialPeer::doSelectWithI18n($c, 'es');

foreach($serials as $s){
  $aux = $s->getMmStatus();
  if($aux["max"] != 3) continue;
  echo $s->getId();
  echo "\n";
  echo $s->getTitle();
  echo "\n";
  echo $s->getDescription();
  echo "\n\n\n";
}
