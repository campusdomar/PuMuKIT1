<?php

/**
 * Finalizado batch script
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

//EJECUTO SIGUIENTE
$aux = CpuPeer::getFree();
if ($aux){
  echo "El siguente libre es id:".$aux->getId()." con IP ".$aux->getIp()."\n";  
}else{
  echo "Ocupados\n";  
}




