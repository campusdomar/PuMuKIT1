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
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


/*******************************************************
 * START                                               *
 *******************************************************/

//
//OBTENGO TAREA A TRANSCODIFICAR
//
if (2 != count($argv)) exit(-1);
if (($id =intval($argv[1])) == 0)  exit(-1);

//OBTENGO TAREA
$trans = TranscodingPeer::retrievebyPk($id);


$trans->getMm()->activeAnyPubChannel($trans->getPerfil());
