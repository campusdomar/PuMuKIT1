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

$c->add(TranscodingPeer::PERFIL_ID, array(21, 20), Criteria::IN);
$c->add(TranscodingPeer::NAME, "PODCAST");
$c->add(TranscodingPeer::STATUS_ID, -1);

$errors = TranscodingPeer::doSelect($c);

echo count($errors) , "\n";

foreach($errors as $e){
      $e->setStatusId(1);
      $e->setPriority(2);
      $e->setTimeini('now');
      $e->save();
      
      TranscodingPeer::execNext();
}
