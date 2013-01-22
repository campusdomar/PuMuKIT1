<?php

/**
 * Init_file batch script
 *
 * Script que inicializa el perfil de los direfentes archivos de video segun sea
 * los valores devueltos por la libreria getid3. Es necesario tener acceso fisico
 * al archivo multimedia
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


$cero = 0;
$a43 = 0;
$a54 = 0;
$a169 = 0;
$files = FilePeer::doSelect(new Criteria());
$i =0;
foreach($files as $file){
  $i++;
  $ss = sprintf('%.2f' ,($file->getResolutionHor()/$file->getResolutionVer()));
  echo $ss;
  echo "\t";
  if (($i % 5) == 0) echo "\n";
  if($ss == 0.00) $cero++;
  if($ss == 1.33) $a43++;
  if($ss == 1.25) $a54++;
  if($ss == 1.78) $a169++;
}

echo "\n";
echo "tengo:";
echo $cero , " ";
echo $a43 , " ";
echo $a54 , " ";
echo $a169 , " ";
echo "\n";
