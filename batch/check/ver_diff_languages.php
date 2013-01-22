<?php

/**
 * list diff languages batch script
 *
 * Lista los Objetos Multimedia que tienen archivos multimedia con dos idiomas diferentes.
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

//echo "START 1\n\n\n";
  $i =0;
$c = new Criteria();
$c->add(SerialPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
SerialPeer::addBroadcastCriteria($c, array('pub'));
SerialPeer::addPublicCriteria($c, 2);

$serials = SerialPeer::doSelectWithI18n($c, 'es');

echo "Numero de series: " . count($serials) . "\n";

foreach($serials as $s){
  $ms = $s->getMmsPublic();
  $ok = true;

  foreach($ms as $m){
    $languages = $m->getLanguages();
    if(count($languages) == 1) continue;
    echo $s->getId() . "\t" . $s->getTitle() . "\n";
    echo "\t" , $m->getId() . "\t" . $m->getTitle() . "\n";

    $files = $m->getFiles();
    foreach($files as $f){
      echo "\t\t" , $f->getId(). "\t" . $f->getPerfil()->getName() . "\t(" . $f->getLanguageId(). ")" . $f->getLanguage()->getName() . "\n";
    }

    
    $i++;
    echo "\n\n";
  }
}

echo "TOTAL $i\n";