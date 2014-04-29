<?php

/**
 * profile batch script
 *
 * Script que elementos que tiene relaciones rotas.
 * (Objetos multimedia sin series; Archivos de video, Materiales,
 * Links, Areas de Conocimiento y Personas que no tienen Objetos Multimedia)
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

echo "Start\n";

echo "Updating multimedia objects\n";
foreach(FilePeer::doSelect(new Criteria()) as $f) $f->save();
foreach(MmPeer::doSelect(new Criteria()) as $mm) $mm->save();
echo "Updated multimedia objects\n";



echo "Syncing grounds and categories\n";
foreach(MmPeer::doSelect(new Criteria()) as $mm) {
  foreach($mm->getGrounds() as $g){
    $cat = CategoryPeer::retrieveByCode($g->getCod());
    if($cat) {
      $cat->addMmId($mm->getId());
    } else {
      echo " - Not category with code \"" . $g->getCod() . " - " . $g->getName() . "\"; error sync grounds and categories\n";
    }

  }
}
echo "Synced grounds and categories\n";


echo "Updating profiles\n";
foreach(PerfilPeer::doSelect(new Criteria()) as $p) {
  if ($p->getTypeString() == "MASTER") {
    $p->setMaster(true);
    $p->save();
  }
}
echo "Updated profiles\n";
