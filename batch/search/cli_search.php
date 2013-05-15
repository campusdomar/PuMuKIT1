<?php

/**
 * cli_search
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

if (2 != count($argv)) exit(-1);
//if (($id =()) == 0)  exit(-1);

// batch process here

//$t = TranscodingPeer::retrieveByPK(65);
//var_dump($t->getBatAuto());


var_dump(utf8_decode($argv[1])); exit;

//MmPeer::getLuceneIndex();
$mms = MmPeer::getForLuceneQuery($argv[1]);
foreach($mms as $mm){
  echo "ID: ". $mm->getId()."\n";
  echo "Title: ". $mm->getTitle()."\n";
  echo "Subtitle: ". $mm->getSubtitle()."\n";
  echo "Description: ". $mm->getDescription()."\n";

  $persons = $mm->getPersons();
  $personStr = "";

  foreach($persons as $person){
    $personStr .= $person->getName();
  }
  
  echo "Persons: " . $personStr."\n";
  //  var_dump("Title: ". $mm->getKeywords());
  
}