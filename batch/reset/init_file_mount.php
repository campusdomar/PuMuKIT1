<?php

/**
 * Init_file batch script
 *
 * Script que inicializa el perfil de los direfentes archivos de video segun sea
 * los valores devueltos por la libreria getid3. Es necesario tener acceso fisico
 * al archivo multimedia
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
    if (!file_exists($file->getUrlMount())){
      echo "\n\nError file no existe" . $file->getUrl() . "\n***********************************\n\n\n";
      $file->setPerfilId(8);
      //$file->save();
      continue;
    }

    echo "TENGO: ".$file->getId()."-\t".$file->getUrl()." \n";
    echo "TENGO: ".$file->getId()."-\t".$file->getUrlMount()." \n";
    echo "RESOLUCION_data: ".$file->getResolution()." \n";
  
    if (!file_exists($file->getUrlMount())) continue;
    $movie = new ffmpeg_movie($file->getUrlMount());
    if (!$movie){
      return 0;
    }
    //echo $movie->getDuration();
    echo "RESOLUCION_real: ", $movie->getFrameWidth(), 'x',$movie->getFrameHeight(), "\n";
    
    //$file->save();
  }catch(Exception $e){
    echo "\n\nError analizar" . $file->getUrl() . "\n***********************************\n\n\n";
  }
  echo "\n";
}