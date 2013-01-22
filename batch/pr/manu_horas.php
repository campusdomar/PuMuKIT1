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

$c->addJoin(FilePeer::MM_ID, MmPeer::ID);
$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
$c->add(MmPeer::STATUS_ID, 1, Criteria::GREATER_EQUAL);

$c->add(MmPeer::PRECINCT_ID, array(63,28,69,61,38), Criteria::NOT_IN);

$criterion = $c->getNewCriterion(MmPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
$criterion->addAnd($c->getNewCriterion(MmPeer::PUBLICDATE, "2008-12-31", Criteria::LESS_EQUAL));
$c->add($criterion);

$c->add(PerfilPeer::DISPLAY, true);

$files = FilePeer::doSelect($c);

$total = 0;
foreach($files as $f){
  echo $f->getId() . " - " .$f->getMm()->getPublicDate('d/m/Y'). " - " . $f->getDuration() . " - " . $f->getPerfil()->getName() . "\n";
  $total += $f->getDuration();
}

echo "TOTAL seg:" . $total . "\n";
echo "TOTAL seg:" . ($total/3600) . "\n";