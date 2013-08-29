<?php
/**
 * Resetea numero de obj.mm que tiene cacheadas las categorias.
 * 
 * @package    pumukit
 * @subpackage batch
 * @author     Andres Perez <aperez@teltek.es>
 * @version    0.1
 * @copyright  Teltek 2013
 */
define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();



$cats = CategoryPeer::doSelect(new Criteria());
foreach($cats as $c){
  $cr = new Criteria();
  $cr->add(CategoryMmPeer::CATEGORY_ID, $c->getId());
  $aux = CategoryMmPeer::doCount($cr);
  echo $c->getId(), " ", $c->getNumMm(), " -> ", $aux, "\n";
  $c->setNumMm($aux);
  $c->save();
}