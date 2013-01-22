<?php

/**
 * Script para transcodificar creando una nueva serie. Inicializa el titulo de la serie con el 
 * nombre del directorio donde estan los videos, y el titulo de los videos con
 * 
 * php trans_batch.php dir mm_id language_id [perfil(s)]
 *    -dir es el directorio donde estan los videos
 *    -mm_id id del objeto multimedia asociado
 *    -language_id id del lenguage del video
 *    -perfil es un string de la forma 1-5-7 con los id de los perfile a trans. Opcional
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


/*******************************************************
 * START                                               *
 *******************************************************/
set_time_limit(0);
$langs = sfConfig::get('app_lang_array', array('es'));
if ((3 != count($argv)) && (4 != count($argv))) {
  echo "PARAM ERROR: uso: php trans_batch.php dir language_id [perfil(s)]\n";
  exit(-1);
}


if (($language_id =intval($argv[2])) == 0) {
  echo "PARAM ERROR: language_id not integer \n";
  exit(-1);
}

      
$lang = LanguagePeer::retrieveByPK($language_id);
if($lang == null) {
  echo "LANGUAGE ERROR: not language \n";
  exit(-1);  
}

if(!file_exists($argv[1])){
  echo "FILE ERROR: file not exists (" . $argv[1] . ")\n";
  exit(-1); 
}


if (3 == count($argv)){
  echo "default\n";
  $c = new Criteria();
  $c->addAscendingOrderByColumn(PerfilPeer::RANK);
  $c->add(PerfilPeer::WIZARD, true);
  $profiles = PerfilPeer::doSelect($c);
}else{
  if ($argv[3] == 'all'){
    $c = new Criteria();
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);
    $profiles = PerfilPeer::doSelect($c);
  }else{
    $profiles = PerfilPeer::retrieveByPKs(explode("-", $argv[3])); 
  }
}

if(count($profiles) == 0){
  echo "PERFIL ERROR: No perfil\n";
  exit(-1); 
}


$serial = null;
echo "START\n";

$files = sfFinder::type('file')->maxdepth(0)->prune('.*')->in($argv[1]);

foreach($files as $file){

  echo "-Process file:" . $file . "\n";
  $file_name = basename($file);

  $path_video_tmp = $file;

  //analizo archivo
  try {
    $duration = FilePeer::getDuration($path_video_tmp);
  }
  catch (Exception $e) {
    echo "  GETID3 ERROR: (FilePeer::getDuration)\n";
    //unlink($path_video_tmp);
    continue; 
  }

  //creo serial
  if($serial == null){
    $serial = SerialPeer::createNew(false);
    foreach($langs as $l){
      $serial->setCulture($l);
      $serial->setTitle(basename($argv[1])); 
    }
    $serial->save();
  }

  //creo objeto multimedia
  $mm = MmPeer::createNew($serial->getId());
  if(ereg('^([0-9]{6})_([0-9]+_)*(.*)\.(.{3})', basename($file), $out) != false){
    list($y_mm, $m_mm, $d_mm) = str_split($out[1], 2);
    $title_mm = $out[3];

    $mm->setRecordDate(mktime(0, 0, 0, $m_mm, $d_mm, $y_mm));
  }else{
    $title_mm = basename($file);
  }
  $mm->setPublicDate('now');
  $mm->getRecorddate();

  foreach($langs as $l){
    $mm->setCulture($l);
    $mm->setTitle($title_mm); //falta def title
  }
  $mm->save();

  foreach($profiles as $profile){
    echo "  -Process profile: " . $profile->getName() . "\n";
    $trans = new Transcoding();
    $trans->setPerfilId($profile->getId());
    $trans->setStatusId(1);
    $trans->setPriority(2);
    $trans->setTimeini('now');
    $trans->setMmId($mm->getId());
    
    foreach($langs as $l){
      $trans->setCulture($l);
      $trans->setDescription('Automatic task');
    }
      	
    $trans->save();
    echo "  -Tarea numero: " . $trans->getId() . "\n";

      	//CREO PATHS
    $extension = substr($file_name, -3, 3);
    $extension_final = (($profile->getExtension() == '???')?($extension):($profile->getExtension()));
    
    $dir_temp = $profile->getDirOut() . '/' . sfConfig::get('app_transcoder_proveedor').'/'.
      $mm->getSerial()->getPublicDate('ymd').'_'.elimina_acentos($mm->getSerial()->getTitle()).'_'.$mm->getSerialId();
    @mkdir($dir_temp, 0777, true);
    
     	
    $dir_salida = $dir_temp.'/'.$mm->getRecordDate('ymd').'_'.elimina_acentos($mm->getTitle()).'_'.
      $lang->getCod().'('.$profile->getName().')_'.$trans->getId().'.'.$extension_final;
    
    //COMPLETO TAREA
    $trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
    $trans->setLanguage($lang);
    //$trans->setComment()//varios idiomas
    //falta duracion
    $trans->setPid(0);
    $trans->setEmail("rubenrua@uvigo.es");
    
    $trans->setDuration($duration);
    $trans->setPathIni($path_video_tmp);
    $trans->setPathEnd($dir_salida);
    $trans->setUrl($trans->getPathEnd());
    
    $trans->setExtIni($extension);
    $trans->setExtEnd($extension_final);
    $trans->save();
    
    TranscodingPeer::execNext();
    
  } 
}


function elimina_acentos($cadena){
  //Elimina acentos y caracteres no validos de los nombres de los videos
  $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿñÑ";
  $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuynN"; 
  return(ereg_replace('[^0-9A-Za-z]', '_', strtr(utf8_decode($cadena),$tofind,$replac)));
} 