#!/usr/bin/env php

<?php

/**
 * pr batch script
 *
 * Here goes a brief description of the purpose of the batch script
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


$name = sfConfig::get('sf_log_dir').'/nettraker.txt';


$gestor = @fopen($name, "r");
if ($gestor) {
  while (!feof($gestor)) {
    $bufer = fgets($gestor, 4096);
    $array = explode(',',$bufer);
    if(sizeof($array) == 6){
      $texto = substr($array[0], 1 , -1);
      echo $texto. '-'.$array[4]."\n";
      $c = new Criteria();
      $c->add(FilePeer::URL, '%'.$texto, Criteria::LIKE);
      $file = FilePeer::doSelectOne($c);
      if ($file) {
	echo $file->getUrl()."\n\n";
	$file->setNumView(intval($array[4]));
	$file->save();
      }else{
        echo "ERROR ->" . $texto . "\n";
      }
    }
  }
  fclose ($gestor);
}


