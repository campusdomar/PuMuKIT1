<?php

/**
 * mm_perfil_status
 *
 * Script que conprueba que todos los obetos multimedia tinen un master, un wmv y un podcast.
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
$mms = MmPeer::doSelectWithI18n($c);

$i = 0;
foreach($mms as $mm){
  $perfiles = $mm->getPerfilIds();
  echo $mm->getId() . "\t" . $mm->getTitle() . "\t". count($perfiles). "(";
  foreach($perfiles as $p) echo $p . " ";
  echo ")\n";

  //NO WMV
  if(NULL == array_intersect($perfiles, array(1,2,3,5,8,24,18,26,19,25,12))){
    echo "  - No WMV\n";
  }
  //NO PODCAST
  if(NULL == array_intersect($perfiles, array(20,22))){
    echo "  - No PODCAST\n";
  }
  //NO MASTER
  if(NULL == array_intersect($perfiles, array(6,7,10))){
    echo "  - No MASTER\n";
  }
}


echo $i;