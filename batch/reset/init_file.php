<?php

/**
 * Init_file batch script
 *
 * Script que inicializa el perfil de los direfentes archivos de video segun sea
 * los valores devueltos por la libreria getid3
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
  $file->setPerfilId(1);
  $file->save();
  echo $file->getUrl() . "\n";
}