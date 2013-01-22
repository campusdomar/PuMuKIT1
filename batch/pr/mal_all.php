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

$c = new Criteria();
$c->add(SerialPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
//SerialPeer::addBroadcastCriteria($c, array('pub'));
SerialPeer::addPublicCriteria($c, 2);

$serials = SerialPeer::doSelectWithI18n($c, 'es');

echo "Numero de series: " . count($serials) . "\n";

foreach($serials as $s){
  $ms = $s->getMmsPublic();
  foreach($ms as $m){
    if ($m->getBroadcastId() != 1){
      echo $s->getId() . "\t" . $s->getTitle() . "\n";
      echo $m->getId() . "\t" . $m->getTitle() . "\n--\n";
    }
  }

  

}


