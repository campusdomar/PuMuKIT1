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

  $master = null;

  if(!file_exists($file->getFile())){
    if($file->getPerfilId() == 12){
      echo "ERROR ".++$i."\n";
      echo "ID:\t" . $file->getID() . "\n";
      echo "PERFIL_ID:\t" . $file->getPerfilId() . "\n";
      echo "MM:\t" . $file->getMmId() . "\n";
      echo "MM:\t" . $file->getMm()->getTitle() . "\n";
      echo "SERIAL:\t" . $file->getMm()->getSerialId() . "\n";
      echo "SERIAL:\t" . $file->getMm()->getSerial()->getTitle() . "\n";
      echo "FILE:\t" . $file->getFile() . "\n";
      echo "URL:\t" . $file->getUrl() . "\n";

      $ofiles = $file->getMm()->getFilesByPerfil(6);
      echo "TENGO:\t" . count($ofiles) . "\n";

      foreach($ofiles as $ofile){
	echo "\tRES:\t" . $ofile->getResolutionHor() . "x" . $ofile->getResolutionVer();
	if ($ofile->getResolutionHor() == 1280){
	  $master = $ofile;
	  echo " * ";
	}
	echo "\n";
      }

      if ($master != null){
	echo "***\n";
	$master->retranscoding(12, 1, 1);
      }
      echo "--------------------------------------------\n\n\n";
      
    }
  }
}
