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

$serials = SerialPeer::retrieveByPKs(array(282, 588));

foreach($serials as $s){
  echo $s->getId() . "\n";
  echo $s->getTitle() . "\n";
  echo "-------------------------------------------------------";
  $mms = $s->getMmsPublic();
  foreach($mms as $mm){
    echo $mm->getId(). "\n" . $mm->getTitle() ."\n";
    $files = $mm->getFilesPublic();
    foreach($files as $f){
      echo "http://tv.uvigo.es/video/".$f->getId() . "   ";
    }
    echo "\n\n";
  }
  echo "\n\n\n\n";
}