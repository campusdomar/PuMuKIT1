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
SerialPeer::addBroadcastCriteria($c, array('pub'));
SerialPeer::addPublicCriteria($c, 2);

$serials = SerialPeer::doSelectWithI18n($c, 'es');

echo "Numero de series: " . count($serials) . "\n";

foreach($serials as $s){
  $ms = $s->getMmsPublic();
  $ok = true;
  echo $s->getId() . "\t" . $s->getTitle() . "\n";

  foreach($ms as $m){
    $perfiles = $m->getPerfilIds();
    if (in_array(1, $perfiles) && (in_array(21, $perfiles))) continue;
    if (array_intersect(array(1,2,3,5,18,28,26,24,19,25,12,8), $perfiles)){
      if (in_array(21, $perfiles)) continue;
      if (in_array(20, $perfiles)) continue;
      if (in_array(22, $perfiles)) continue;
      //$ok = false;
      echo "\t - KO\t" . $m->getId() . "\t" . $m->getTitle() . "\n";
      echo "\tPerfiles (" . implode(",", $perfiles) . ")\n";
      echo "\n";
    }
  }

  if($ok){
    itunes::AddCourse($s->getId(), TRUE);
    echo "\t - OK\n";
  }
}


