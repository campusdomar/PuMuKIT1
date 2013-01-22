<?php

/**
 * Crea DVD.
 *
 * Con la informacion almacenada en ./DVDMaterial crea el DVD para  regalar
 * FALTA POR TERMINAR
 * 
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// VALORES A CAMBIAR
echo "START 1\nFALTA POR TERMINAR\n\n";
$ruta = '/mnt/descargatv/tmp/DVD';


//START
if(count($argv) != 2){
  echo "Error ne parametros \n";
  exit;
}

if(($serial = SerialPeer::retrieveByPkWithI18n($argv[1], 'es')) == null){
  echo "No Existe la seria de id " . $argv[1] . " \n";
  exit;
}

if(!file_exists($ruta)){
  echo "No Existe la ruta: $ruta\n";
  exit;
}

$mms = $serial->getmms();

echo $serial->getTitle(), "\n";

//BORRO Y COPIAR ESTRUCUTRA
mkdir($ruta . "/Videos/");

$status = array();

foreach($mms as $i => $m){
  $status[$m->getId()] = $m->getStatusId();
  $files = $m->getFilesPublic();
  foreach($files as $f){
    echo $i . "- copy " . $f->getFile() . " " . $ruta . "/Videos/\n";
    copy($f->getFile(), $ruta . "/Videos/" . basename($f->getFile()));
    $aux = file_get_contents('./DVDMaterial/asx.asx');
    $num = 0;
    $aux = str_replace('%file%', basename($f->getFile()), $aux, $num);
    $aux = str_replace('%title%', $m->getTitle(), $aux);
    file_put_contents($ruta . "/Videos/" . $f->getId() . ".asx", $aux);

  }

}


//COPIAR PICTURES
//CREAR HTML
