<?php

/**
 * profile batch script
 *
 * Script que borrar los Archivos de Video de la serie de prueba 313
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
echo "START\n\n\n";

$c = new Criteria();
$c->addJoin(FilePeer::MM_ID, MmPeer::ID);
$c->add(MmPeer::SERIAL_ID, 313);

$aux = FilePeer::doSelect($c);
foreach($aux as $a){
  echo $a->getId().'-'.$a->getUrl()."\n";
  $a->delete();
}


echo "Files de mm 313  borrados\n";