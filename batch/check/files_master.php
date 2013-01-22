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

$master = "/mnt/tmp3/MASTERS/";

$files = sfFinder::type('file')->prune('.*')->discard('.*')->relative()->in($master);
foreach($files as $file){
  if(substr($file, -10) === "/Thumbs.db") continue;
  $c = new Criteria();
  $c->add(FilePeer::FILE, "%".$file, Criteria::LIKE);
  $num = FilePeer::doCount($c);
  if (substr($file, -4) == ".jpg") continue;
  if (substr($file, -4) == ".JPG") continue;
  if ($num == 1) continue; 
  echo $master . $file . " (". $num .")\n\n";
}