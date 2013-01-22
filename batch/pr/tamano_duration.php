#!/usr/bin/env php

<?php

/**
 * pr batch script
 *
 * Here goes a brief description of the purpose of the batch script
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

$c = new Criteria();
$c->add(FilePeer::PERFIL_ID, $argv[1]);
$files = FilePeer::doSelect($c);

$i = 1;
echo "i \t file \t Durat. \t Size \n";
foreach($files as $f){
  
  if (file_exists($f->getFile()))
    //if ($f->getSize() != 0)
    echo ($i++) . " \t " . $f->getId() . " \t " . $f->getDuration() ." \t " . $f->getSize() . " \n";
}

echo "Tengo: ". $i ."(" . count($files) . ") archivos\n";