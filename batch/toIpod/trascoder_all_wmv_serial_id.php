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
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here

echo "START 1\n\n\n";

if(count($argv) != 2){
  echo "Error ne parametros \n";
  exit;
}

if(($serial = SerialPeer::retrieveByPkWithI18n($argv[1], 'es')) == null){
  echo "No Existe la seria de id " . $argv[1] . " \n";
  exit;
}

echo "PROCESANDO LA SERIE: (" . $serial->getId(). ") " . $serial->getTitle() . " \n";


$mms = $serial->getMms();

$i = 0;
foreach($mms as $mm){
  $file = $mm->getFileByPerfil(1);
  if (is_null($mm)){
    echo "Error por perfil";
    continue;
  }
  
  echo $file->getId()."\n";

  $file->retranscoding(21);
  
}