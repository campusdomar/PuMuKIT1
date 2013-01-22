<?php

  /**
   * import data from other tables
   *
   * @package    pumukit17
   * @subpackage batch
   * @version    $Id$
   */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

$log = new sfFileLogger();
$log->initialize(array('file' => SF_ROOT_DIR . '/batch/import/log_other.log'));

$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

/* Cargar los tres ficheros de log id antigo -> id nuevo 
(serial, mm y file) en arrays.

Cargar desde la BD log_email, hacer 3 listas de objetos 
con los resultados por serial, mm y video.

Recorrer lista BD.
	Por cada ID:
		Buscar en el array correspondiente .
		Actualizar el objeto con el nuevo valor del log y guardar.
		Warning si no existe el id antiguo en el array.
			Borrar entradas huérfanas de la BD.
*/

updateLogEmailType("video", "lista_ordenada_file_importados.txt"); 
updateLogEmailType("mm", "lista_ordenada_mm_importados.txt");
updateLogEmailType("serial", "lista_ordenada_serial_importados.txt");

showAndLog("\nProceso terminado.\n");

function updateLogEmailType($type, $filename){
	showAndLog("\n\n\n----------------------------------------------------------
	Actualizando la asignación de " . $type . "\n\n\n");
	$log_array = array();
	$log_array = cargaLog ($filename);

	$c = new Criteria();
	$c->add(LogEmailPeer::TYPE, $type);
	$log_email_found = LogEmailPeer::doSelect($c);

	foreach ($log_email_found as $le) {
		$old_id = $le->getObjectId();
		
		if (!array_key_exists($old_id, $log_array)) {
			showAndLog("No existe valor antiguo para el " . $type . " id=" . 
				$old_id . "\"", "Warning");
			showAndLog("Borrando entrada log_email huérfana con id=\"" . 
				$le->getId() . "\"en la nueva BD\n", "Warning");
			$le->delete();
		} else {
			$new_id = $log_array[$old_id];		
			showAndLog("Actualizando log_email id=\"" . $le->getId() . "\" " . 
				$type . " con id=\"" . $old_id . "\" por el nuevo id=\"" . 
				$new_id . "\"");
			$le->setObjectId($new_id);
			$le->save();
		}
	}
}


function cargaLog ($filename){
	$log_array = array();
	showAndLog("Cargando " . $log_file . "\n");
	$log_files = array();
	foreach(file($filename) as $key => $value){
		$linea = explode(" ",$value);
		$log_array[$linea[0]] = $linea[1];
	}

	return $log_array;
}

function showAndLog($mensaje, $tipo = "Info"){
	global $log;
	switch ($tipo) {
		case "Info":
		    echo "\033[32mInfo:\033[37m ";
		  	break;
		case "Warning":
		  	echo "\033[35mAviso:\033[37m ";
		  	break;
		case "Debug":
			echo "\033[133mDebug:\033[37m ";
			break;
		case "Error":
		  	echo "\033[31mError:\033[37m ";
		  	break;
		case "New":
		  	echo "\033[34mNew:\033[37m ";
		  	break;
	}
	echo $mensaje . "\n";
	$log->log($mensaje, 0, $tipo);
}