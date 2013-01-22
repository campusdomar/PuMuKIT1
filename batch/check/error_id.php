<?php

/**
 * profile batch script
 *
 * Script que elementos que tiene relaciones rotas.
 * (Objetos multimedia sin series; Archivos de video, Materiales,
 * Links, Areas de Conocimiento y Personas que no tienen Objetos Multimedia)
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
 * Compruebo Objetos Multimedia que no tengan Series
 *
 */

$c = new Criteria();
$c->add(MmPeer::SERIAL_ID, ' serial_id not in (select id from serial)', Criteria::CUSTOM);

$mms = MmPeer::doSelect($c);
echo 'Numero de objetos multimedia sin series: '.count($mms)."\n";



/**
 *
 * Compruebo Archivos de Video que no tengan Objetos Multimedia
 *
 */

$c = new Criteria();
$c->add(FilePeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$files = FilePeer::doSelect($c);
echo 'Numero de archivos de video sin objeto multimedia: : '.count($files)."\n";



/**
 *
 * Compruebo Archivos de Video que no tengan Perfil
 *
 */

$c = new Criteria();
$c->add(FilePeer::MM_ID, ' perfil_id not in (select id from perfil)', Criteria::CUSTOM);

$files = FilePeer::doSelect($c);
echo 'Numero de archivos de video sin perfil: : '.count($files)."\n";



/**
 *
 * Tareas de Video que no tengan Perfil
 *
 */

$c = new Criteria();
$c->add(TranscodingPeer::MM_ID, ' perfil_id not in (select id from perfil)', Criteria::CUSTOM);

$files = TranscodingPeer::doSelect($c);
echo 'Numero de tareas sin perfil: : '.count($files)."\n";


/**
 *
 * Compruebo Materiales que no tengan Objetos Multimedia
 *
 */

$c = new Criteria();
$c->add(MaterialPeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$materials = MaterialPeer::doSelect($c);
echo 'Numero de materiales sin objeto multimedia: : '.count($materials)."\n";



/** *
 * Compruebo Links que no tengan Objetos Multimedia
 *
 */

$c = new Criteria();
$c->add(LinkPeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$links = LinkPeer::doSelect($c);
echo 'Numero de links sin objeto multimedia: : '.count($links)."\n";




/**
 *
 * Compruebo Areas de Conocimento que no tengan Objetos Multimedia
 *
 */

$c = new Criteria();
$c->add(GroundMmPeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$grounds = GroundMmPeer::doSelect($c);
echo 'Numero de areas de conocimineto sin objeto multimedia: : '.count($grounds)."\n";


/**
 *
 * Compruebo Personas que no tengan Objetos Multimedia
 *
 */

$c = new Criteria();
$c->add(MmPersonPeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$persons = MmPersonPeer::doSelect($c);
echo 'Numero de personas sin objeto multimedia: : '.count($persons)."\n";


/**
 *
 * Compruebo tareas que no tengan Objetos multimedia
 *
 */

$c = new Criteria();
$c->add(TranscodingPeer::MM_ID, ' mm_id not in (select id from mm)', Criteria::CUSTOM);

$jobs = TranscodingPeer::doSelect($c);
echo 'Numero de tareas sin objetos multimedia: '.count($jobs)."\n";
