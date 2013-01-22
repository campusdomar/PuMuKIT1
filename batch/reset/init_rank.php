<?php

/**
 * Init_rank batch script
 *
 * Inicializa el orden (rank) de los Objetos Multimedia, Archivos de video, 
 * Personas en los Objetos Multimedia y Grounds en los Objetos multimedia.
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

/**
 *
 * Ordena los Objetos multimedia en las Series (por fecha de grabacion)
 *
 */
echo "Ordenando MM\n";
$serials = SerialPeer::doSelect(new Criteria());
foreach($serials as $serial){
  $c = new Criteria();
  $c->addAscendingOrderByColumn(MmPeer::RECORDDATE);
  $c->add(MmPeer::SERIAL_ID, $serial->getId());
  $mms = MmPeer::doSelect($c);
  $rank = 1;
  foreach($mms as $mm){
    $mm->setRank($rank++);
    $mm->save();
  }
}

unset($serial, $mm, $mms);

/**
 *
 * Orden Archivos de Video en los Objetos multimedia
 *
 */
echo "Ordenando FILE\n";
$mms = MmPeer::doSelect(new Criteria());
foreach($mms as $mm){
  $files = $mm->getFiles();
  $rank = 1;
  foreach($files as $file){
    $file->setRank($rank++);
    $file->save();
  }
}

unset($file, $files);



/**
 *
 * Orden Personas en los Objetos multimedia
 *
 */
echo "Ordenando PERSON\n";
foreach($mms as $mm){
  $persons = $mm->getMmPersons();
  $rank = 1;
  foreach($persons as $person){
    $person->setRank($rank++);
    $person->save();
  }
}
unset($person, $persons);


/**
 *
 * Orden Ground en los Objetos multimedia
 *
 */
echo "Ordenando GROUND\n";
foreach($mms as $mm){
  $grounds = $mm->getGroundMms();
  $rank = 1;
  foreach($grounds as $ground){
    $ground->setRank($rank++);
    $ground->save();
  }
}
unset($grounds, $ground);




/**
 *
 * Ordeno pic_mm
 *
 */
echo "Ordeno PIC_MM\n";
foreach($mms as $mm){
  $pics = $mm->getPicMms();
  $rank = 1;
  foreach($pics as $pic){
    $pic->setRank($rank++);
    $pic->save();
  }
}


unset($mm, $mms, $pic, $pics);



/**
 *
 * Ordeno pic_serial
 *
 */
echo "Ordeno PIC_SERIAL\n";
foreach($serials as $serial){
  $pics = $serial->getPicSerials();
  $rank = 1;
  foreach($pics as $pic){
    $pic->setRank($rank++);
    $pic->save();
  }
}


unset($serial, $serials, $pic, $pics);