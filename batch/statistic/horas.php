<?php

/**
 * profile batch script
 *
 * Script que muestra el numero de horas de todos los lugares.
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

$places = PlacePeer::doSelect(new Criteria);

foreach($places as $p){
  $c = new Criteria();

  $criterion = $c->getNewCriterion(MmPeer::RECORDDATE, "$2007-09-01", Criteria::GREATER_EQUAL); //y-m-d
  $criterion->addAnd($c->getNewCriterion(MmPeer::RECORDDATE, "2008-09-01", Criteria::LESS_EQUAL));
  $c->add($criterion);

  $c->add(PrecinctPeer::PLACE_ID, $p->getId());
  $c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
  $c->addJoin(FilePeer::MM_ID, MmPeer::ID);
  $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
  $c->add(PerfilPeer::DISPLAY, true); //OJO BORRAR
  $c->add(FilePeer::DISPLAY, true);

  $files =  FilePeer::doSelect($c);

  $duration = 0;
  foreach($files as $f){
    $duration += $f->getDuration();
  }
  if ($duration == 0) continue;
  echo $p->getName() . "\n";
  echo $duration . " seg";
  echo "\t" . sprintf("%.2f", $duration/3600) . " horas";
  echo "\n\n";
}