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


$c = new Criteria();

//OTROS
$c->add(FilePeer::PERFIL_ID, array(20, 21), Criteria::IN);
$c->addJoin(FilePeer::MM_ID, MmPeer::ID);
$c->add(MmPeer::BROADCAST_ID, 1);
$files = FilePeer::doSelect($c);


foreach($files as $f){

  if (!file_exists($f->getFile())) continue;
  echo $f->getId();
  echo "\n";
 

  $trans = new Transcoding();

  $trans->setPerfilId(22); //audio

  $trans->setStatusId(1);
  $trans->setPriority(1);  
  $trans->setTimeini('now');
  $trans->setMmId($f->getMmId());
  	
  $langs = sfConfig::get('app_lang_array', array('es'));
  foreach($langs as $l){
    $trans->setCulture($l);
    $f->setCulture($l);
    $trans->setDescription($f->getDescription());
  }
  
  $trans->save();
      
  $trans->setName("PODCAST");
  $trans->setLanguage($f->getLanguage());
  
  $trans->setPid(0);
      
  $trans->setDuration($f->getDuration());
  $trans->setPathsAuto($f->getFile());
  $trans->setUrl($trans->getPathEnd());
  $trans->save();
      
  TranscodingPeer::execNext();

}