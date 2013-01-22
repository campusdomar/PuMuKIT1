<?php

/**
 * files.php
 *
 * Script que muestra por un lado los files de la base de datos que no 
 * poseen Archivo fisico real. Y por otro lado los archivos fisico que
 * no estan catalogados en la base de datos.
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
$i = 0;


echo "############################################\n";
echo "#########   NO EXISTE FILE   ###############\n";
echo "############################################\n";

foreach($files as $file){

  if(!file_exists($file->getFile())){
    echo "ERROR ".++$i."\n";
    echo "ID:\t" . $file->getID() . "\n";
    echo "MM:\t" . $file->getMmId() . "\n";
    echo "MM:\t" . $file->getMm()->getTitle() . "\n";
    echo "SERIAL:\t" . $file->getMm()->getSerialId() . "\n";
    echo "SERIAL:\t" . $file->getMm()->getSerial()->getTitle() . "\n";
    echo "FILE:\t" . $file->getFile() . "\n";
    echo "URL:\t" . $file->getUrl() . "\n";
    echo "--------------------------------------------\n\n\n";
  }
}

echo "############################################\n";
echo "#########   NO EXISTE EN BBDD  #############\n";
echo "############################################\n";
//
//$c = new Criteria();
//$c->add(FilePeer::PERFIL_ID, 6);
//$files = FilePeer::doSelect($c);
//$i = 0;
//
//foreach($files as $file){
//  if(!file_exists($file->getFile())){
//    echo "ERROR ".++$i."\n";
//    echo "ID:\t" . $file->getID() . "\n";
//    echo "MM:\t" . $file->getMmId() . "\n";
//    echo "FILE:\t" . $file->getFile() . "\n";
//    echo "URL:\t" . $file->getUrl() . "\n";
//    echo "--------------------------------------------\n\n\n";
//  }else{
//   // $movie = new ffmpeg_movie($file->getUrlMount(), false);
//   // echo "VIDEO CODEC" . $movie->getVideoCodec() . "\n";
//    
//  }
//}



$files = sfFinder::type('file')->prune('.*')->discard('.*')->relative()->in("/mnt/videoserver/VoDPrivado");
foreach($files as $file){
  if(substr($file, -10) === "/Thumbs.db") continue;
  $c = new Criteria();
  $c->add(FilePeer::URL, "%".$file, Criteria::LIKE);
  $num = FilePeer::doCount($c);
  if ($num == 1) continue; 
  echo "//172.20.209.53/wmpub/VoDPrivado/" . $file . " (". $num .")\n";
}


$files = sfFinder::type('file')->prune('.*')->discard('.*')->relative()->in("/mnt/videoserver/VoD Publico");
foreach($files as $file){
  if(substr($file, -10) === "/Thumbs.db") continue;
  $c = new Criteria();
  $c->add(FilePeer::URL, "%".$file, Criteria::LIKE);
  $num = FilePeer::doCount($c);
  if ($num == 1) continue; 
  echo "//172.20.209.53/wmpub/VoD Publico/" . $file . " (". $num .")\n";
}