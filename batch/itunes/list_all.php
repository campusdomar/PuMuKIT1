<?php

/**
 * profile batch script
 *
 * Script que muestra las urls y resoluciones reales y alamacenadas
 * de todos los archivos de video catalogados en la base de datos.
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



if(strtolower($argv[1]) == "xml"){
  var_dump(itunes::getUrl());
  var_dump(itunes::ShowTree("maximal"));
}else{

  $courses = array();
  $contenido =itunes::ShowTree();
  
  if (!$xml = simplexml_load_string($contenido)){
    echo "Ha ocurrido un error al procesar el documento XML \n";
    exit;
  }else{ 
    foreach(array('es', 'gl', 'en', 'xx') as $lid => $language){
      echo "- " .$language . "\n";
      foreach($xml->Site->Section[$lid]->Division as $d){
	echo "    - (" . $d->Handle . ") " . $d->Name . "\n";
        foreach($d->Section as  $sec){
	  echo "        - (" . $sec->Handle . ") " . $sec->Name . "\n";
	  foreach($sec->Course as $c){
	    if(count($c) == 0) continue;
	    echo "           - (" . $c->Handle . ") " . $c->Name . "\n";
	  }
	}
      }
    }
  }
}




echo "\n\n\n\n\n\n---------------------------------\n";
$c = new Criteria();
$c->add(GroundPeer::GROUND_TYPE_ID, 3);
$c->addAscendingOrderByColumn(GroundPeer::COD);
$gg = GroundPeer::doSelect($c);
foreach($gg as $g){
  echo "-" . $g->getId() . " " . $g->getCod() . " " . $g->getName() . "\n";
}

