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

echo "START\n\n\n";

set_time_limit(0);
ini_set("memory_limit","2560M");

if(count($argv) != 2){
  echo "Error de uso\n";
  exit(-1);
}

echo "Analizando: " . $argv[1].  "\n";

if(!file_exists($argv[1])){
  echo "Archivo no existe\n";
  exit(-1);
}


echo "MIO\n\n\n\n\n\n";

try{
  echo "duration:" . getDuration($argv[1]) . "\n";
}catch(Exception $e){
  echo "Exception" . $e . "\n";
}



function getDuration($file){
  //////////////////////////////////////////////
  //GETID3
  //////////////////////////////////////////////
  $getid3 = new getid3();
  $getid3->encoding = 'UTF-8';
  $getid3->Analyze($file);

  if(!strstr($getid3->info['mime_type'], 'video/') && !strstr($getid3->info['mime_type'], 'audio/')){
    throw new Exception('No multimedia file to get duration');
  }
  $duration = intval($getid3->info['playtime_seconds']);

  if ($getid3->info['playtime_seconds'] == 0){
    $movie = new ffmpeg_movie($file);
    $duration = intval($movie->getDuration());
  }

  return($duration);
}
