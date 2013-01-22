<?php

/**
 * Autocomplete Serial
 *
 * Completa la informacion de los objetos
 * multimedia de la serie obteniendola del
 * primer objeto multimedia.
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
$roles = array(3,5);
$langs = sfConfig::get('app_lang_array', array('es'));
$ground_types = array(1,2,3);

$serial = SerialPeer::retrieveByPKWithI18n(517, 'es');
$mms = $serial->getmms();
$mm_orig = $mms[0];


echo $serial->getTitle(), "\n";
echo $mm_orig->getTitle(), "\n";

foreach($mms as $m){
  //Precinct
  $m->setPrecinctId($mm_orig->getPrecinctId());

  foreach($langs as $l){
    $m->setCulture($l);
    $mm_orig->setCulture($l);

    //Keyword
    $m->setKeyword($mm_orig->getKeyword());
    //Description
    $m->setDescription($mm_orig->getDescription());
    }

  //Person publicador y postp
  foreach($roles as $role){
    $persons = $mm_orig->getPersons($role);
    foreach($persons as $p){
      $aux = new MmPerson();
      $aux->setMmId($m->getId());
      $aux->setRoleId($role);
      $aux->setPersonId($p->getId());
      try{
	$aux->save();
	$aux->iniSort();
      }catch(Exception $e){
      } //Ya usado. 
    }
  }
  
  //Area de conocimiento
  foreach($grount_type as $gtype){
    $grounds = $mm_orig->getGrounds($gtype);
    foreach($grounds as $g){
      $m->setGroundId($g->getId());
    }
  }
  $m->save();
}
