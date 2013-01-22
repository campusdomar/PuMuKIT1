<?php

/**
 * trancoder batch script
 *
 * Script que lanza una tras una, transcodificaciones de los videos contenidos en $path_tmp en el
 * trancodificador de ip por parameto.
 * 
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

if(!in_array(count($argv), array(1, 2))){
  echo "ERROR parametros: php transcoding.php";
  exit(-1);
}

if(count($argv) == 2){
  $cpu = $argv[1];
}else{
  $cpu = "172.20.209.68";
}

$paht_tmp = "/mnt/vodhosting/test/";
$path_out = "/mnt/vodhosting/test/tmp/" . date('dmyGis') . "/";
$delete_out = false;

$log = array();

if(!file_exists($paht_tmp)){
  echo "No exixte el carpeta de test\n";
  exit(-1);
}


$files = $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->in($paht_tmp);

foreach($files as $file){
  echo "-File: " . $file . "\n";
  $lang = LanguagePeer::doSelectOne(new Criteria());
  $path_video_tmp = $file;

  
  //analizo archivo
  try {
    $duration_ini = FilePeer::getDuration($path_video_tmp);
  }
  catch (Exception $e) {
    echo "Error analizando archivo\n";
    continue;
  }
  
  if ($duration_ini == 0){
    echo "Error analizando archivo\n";
    continue;
  }

  $profiles = PerfilPeer::doSelectForMm($path_video_tmp);
  
  foreach($profiles as $profile){
    echo "  -Profile:" . $profile->getName() . "\n";
    $file_out = $path_out . $profile->getName() . '_' . basename($file) . 
      (($profile->getExtension() != '???')?'.'.$profile->getExtension():'');
    echo "    -file out:" . $file_out . "\n";

    $var = exec_bat_curl($profile, $file, $file_out, $cpu);


    //analizo archivo
    try {
      $duration_end = FilePeer::getDuration($file_out);
    }
    catch (Exception $e) {
      $duration_end = 0;
    }
    
    
    $trans = new Transcoding();
    $trans->setPathEnd($file_out);
    $trans->setPathIni($file);

    
    //VEO SI HAY ERROR
    if (TranscodingPeer::search_error($profile->getApp(), $var, $duration_ini, $duration_end, $trans)){
      echo "    -\033[34mOK dur_ini(" . $duration_ini . "), dur_end(" . $duration_end . "), size(". filesize($file_out) .")\033[0m\n";
    }else{
      echo "    -\033[31mERROR dur_ini(" . $duration_ini . "), dur_end(" . $duration_end . "), size(". filesize($file_out) .")\033[0m\n";
    } 
    if ($delete_out) unlink($file_out);
  }


  echo "-------------------------------------------------------\n";
  echo "-------------------------------------------------------\n";
  echo "-------------------------------------------------------\n";
}



function exec_bat_curl($profile, $file, $file_out, $cpu){
  
  $linea_comandos = $profile->getBat();;
  $linea_comandos = str_replace('%1', $file, $linea_comandos);
  $linea_comandos = str_replace('%2', $file_out, $linea_comandos);
  $perfil_path = sfConfig::get('app_transcoder_path_htdocs') . $profile->getFileCfg();
  $linea_comandos = str_replace('%3',$perfil_path, $linea_comandos);
  
  //:)
  $linea_comandos = str_replace(sfConfig::get('app_transcoder_path_unix'), sfConfig::get('app_transcoder_path_win'), $linea_comandos); 
  $linea_comandos = str_replace("/","\\",$linea_comandos);
  $linea_comandos = str_replace("\\i","/i",$linea_comandos); //CAMBIAR FORMA de hacerlo
  
  $linea_comandos .= " \n";
  
  echo "    -bat:\n      ". $linea_comandos . "\n";
  echo "    -cpu: ". $cpu . "\n";
  
  //EJECUTO
  $ch = curl_init('http://' . $cpu . '/webserver.php'); 
    
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic " .  base64_encode("pumukit:PUMUKIT")));
  curl_setopt ($ch, CURLOPT_POST, 1); 
  curl_setopt ($ch, CURLOPT_POSTFIELDS, "ruta=$linea_comandos"); 
  
  $var = curl_exec($ch); 
  $error = curl_error($ch);
  
  return $var;
}