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

$files = sfFinder::type('file')->maxdepth(3)->prune('.*')->in("/mnt/vodhosting/uvigotv/");



foreach($files as $file){
  echo $file . "\n";
  echo substr($file, 23) . "\n";
  $c = new Criteria();
  $c->add(FilePeer::URL, "%" . substr($file, 23), Criteria::LIKE);
  echo "Tengo: " . count(FilePeer::doSelect($c)) . "\n\n";
}

