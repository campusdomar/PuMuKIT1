<?php

/**
 * Init_dep batch script
 *
 * Inicializa en la base de datos los departamento en funcion de la infomacion almacenada en el ldap.
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
//echo "START\n\n\n";


$c = new Criteria();
$c->add(TicketPeer::END, date("Y-m-d H:i:s"), Criteria::LESS_EQUAL);
$tickets = TicketPeer::doSelect($c);

foreach($tickets as $ticket){
  //echo $ticket->getId();
  //echo "\t";
  //echo $ticket->getPath();
  //echo "\n";
  $ticket->delete();
}
