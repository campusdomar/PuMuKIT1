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

$files = FilePeer::doSelect(new Criteria());

foreach($files as $file){
  try{
    echo "TENGO: ".$file->getId()."-\t".$file->getUrl()." \n";
    echo "TENGO: ".$file->getId()."-\t".$file->getUrlMount()." \n";
    echo "RESOLUCION_data: ".$file->getResolution()." \n";
  
    //require_once(SF_ROOT_DIR.'/lib/getid3/getid3.php'); 
    $getid3 = new getid3();
    $getid3->encoding = 'UTF-8';
      
    $getid3->Analyze($file->getUrlMount());

    $temp = current($getid3->info['asf']['video_media']);
    echo "RESOLUCION_real: ".$temp['image_width']."x".$temp['image_height']."\n";
  }catch(Exception $e){
    echo "Error \n";
  }
  echo "\n";
}