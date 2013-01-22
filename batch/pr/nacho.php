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

$serials_id = array(212, 397, 422, 451);
$serials = SerialPeer::retrieveByPKs($serials_id);

foreach($serials as $s){
  echo $s->getId() . "\t" . $s->getTitle() . "\n";
  

  $mms = $s->getMms();
  foreach($mms as $m){
    $vistos = 0;
    $files = $m->getFiles();
    foreach($files as $f){
      $vistos += $f->getNumView();
    }
    echo "\t" . $m->getId() . "\t" . $m->getTitle() . "\t" . $vistos . "\n";
  }
}