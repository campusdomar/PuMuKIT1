<?php

/**
 * init_ground
 *
 * Inicualiza las relations grounds que falatan a cada objeto multimedia
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

$mms = MmPeer::doSelect(new Criteria());

foreach($mms as $mm){
  echo $mm->getId() . "\n";
  $grounds = $mm->getGrounds();
  foreach($grounds as $g){
    $relations = $g->getRelationsId();
    foreach($relations as $r){
      $mm->setGroundId($r);
    }
  }
}