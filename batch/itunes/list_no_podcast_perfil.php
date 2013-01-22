<?php

/**
 * list no podcast perfil batch script
 *
 * Script que lista los Objtos multimedia que no tienen el mp4 (20,21) o
 * mp3 (22) necesarios para el podcast/videocast.
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

$c = new Criteria();
$c->add(SerialPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
$serials = SerialPeer::doSelectWithI18n($c, 'es');

echo "Numero de series: " . count($serials) . "\n";

foreach($serials as $s){
  $ms = $s->getMmsPublic();
  foreach($ms as $m){
    $perfiles = $m->getPerfilIds();
    if (in_array(1, $perfiles) && (in_array(21, $perfiles))) continue;
    if (array_intersect(array(1,2,3,5,18,28,26,24,19,25,12,8), $perfiles)){
      if ((array_intersect(array(21, 20), $perfiles) != null)&&(in_array(22, $perfiles))) continue;

      echo $s->getId() . "\t" . $s->getTitle() . "\n";
      echo $m->getId() . "\t" . $m->getTitle() . "\n";
      //Cojo WMV
      echo "Perfiles (" . implode(",", $perfiles) . ")\n";
      //echo ($f->getAspect()) . "\n";
      //echo ($f->getFile()) . "\n";

      //OJO MPG Y AUDIO.

      
      //if((substr($f->getFile(), -3, 3) == "wmv") && ($f->getAspect() < 1.5)){
      //echo "retrans 4:3\n";
	//$f->retranscoding(21, 2, 1);
      //}
      //elseif((substr($f->getFile(), -3, 3) == "wmv") && ($f->getAspect() >= 1.5)){
      //echo "retrans 16:9\n";
	//$f->retranscoding(20,2 ,1);
      //}
      
      echo "\n";


    }
  }

  //COJO MM PUBLICOS.
  //MIRO SI TIENE WMV.
  //MIRO SI TIENE SU CORRESPONDIENTE POSCAST.
}
