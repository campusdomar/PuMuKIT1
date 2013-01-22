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

$num = array(0,0,0,0,0);
$num_m = 0;

$mms = MmPeer::doSelect(new Criteria());
foreach($mms as $mm){
  $files = $mm->countFiles();

  $c = new Criteria();
  $c->add(PerfilPeer::ID, array(6,7,10), Criteria::IN);
  $c->addJoin(PerfilPeer::ID, FilePeer::PERFIL_ID);
  $masters = $mm->countFiles($c);

  echo $mm->getId() . "----" . $files. "----". $masters."\n";


  if ($files >4) $files = 4;
  $num[$files]++;
  if ($masters > 0) $num_m++;
}


echo "TENGO:\n";
var_dump($num);
echo $num_m, "\n";
