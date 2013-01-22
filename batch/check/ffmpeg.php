<?php


/**
 * ffmpeg batch script
 *
 * Script que comprueba el resultado de duracion de un video.
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


if (count($argv) == 2){
  $file = $argv[1];
}else{
  //$file = '/mnt/tmp3/MASTERS/387/595.avi';
  echo "usar: php ffmpeg.php file\n";
  exit;
}


if(file_exists($file)){
  echo "La duracion es:" . FilePeer::getDurationFfmpeg($file);
}else{
  echo "No existe file";
}



echo "\n";echo "\n";echo "\n";echo "\n";