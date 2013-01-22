<?php

/**
 * profile batch script
 *
 * Script que lista los materiales y archivos de video que no estan fisicamente 
 * alamcanados.
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


/**
 *
 * Archivos de video sin contenido en el video server
 *
 */
echo "Archivos de video sin contenido en el video server:\n";
$files = FilePeer::doSelect(new Criteria());

foreach($files as $file){
  if(file_exists($file->getFile())){
    try{
      //require_once(SF_ROOT_DIR.'/lib/getid3/getid3.php'); 
      $getid3 = new getid3();
      $getid3->encoding = 'UTF-8';
      
      $getid3->Analyze($file->getUrlMount());
      
      $temp = current($getid3->info['asf']['video_media']);
    }catch(Exception $e){
      echo "   -".$file->getId()." -- ".$file->getUrl()."\n";
    }
  }else{
    echo "   -".$file->getId()." -- ".$file->getUrl()."\n";
  }

}



/**
 *
 * Materiales sin contenido en el servidor
 *
 */
echo "MAteriales sin contenido en el servidor\n:";
$materials = MaterialPeer::doSelect(new Criteria());

foreach($materials as $material){
  if (!file_exists(SF_WEB_DIR.DIRECTORY_SEPARATOR.$material->getUrl()))  echo "   -".$material->getId()." -- ".$material->getUrl()."\n";
}