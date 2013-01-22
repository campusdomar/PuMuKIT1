#!/usr/bin/env php

<?php

/**
 * retrans
 *
 * Retranscodifica una serie a un nuevo perfil.
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//START

// batch process here
echo "START\n\n\n";

if(count($argv) !== 3){
  echo "Error de parametros id_serie id_perfil\n";
  exit(-1);
}

//COMPROBAR VALORES
echo "ESTAS SEGURO (s/n)?\n";
$text = fgets (STDIN, 1024);
if ($text !== "s"){
  echo "Salir\n";
  exit;
}

$serie = SerialPeer::retrieveByPKWithI18n($argv[1], 'es');
echo "SERIE:: \"" , $serie->getTitle() , "\"\n";

$mms = $serie->getMms();
foreach($mms as $mm){
  $f = $mm->getFirstFile();
  $aux = $f->retranscoding($argv[2]);
  echo $aux->getId(), '.';

}

echo "\n";



