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


$courses = array();
$contenido =itunes::ShowTree();

if (!$xml = simplexml_load_string($contenido)){
  echo "Ha ocurrido un error al procesar el documento XML \n";
  exit;
}else{ 
  foreach($xml->Site->Section[0]->Division as $d){
    echo "*AREA:      " . $d->Handle . "\t\t" . $d->Name . "\n";
    foreach($d->Section[0]->Course as $c){
      if(count($c) == 0) continue;
      echo "   -COURSE: " . $c->Handle . "\t\t" . $c->Name . "\n";
      $courses[] = strval($c->Handle);
    }
  }
}

