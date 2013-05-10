<?php

/**
 * Finalizado batch script
 *
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


/*******************************************************
 * START                                               *
 *******************************************************/

//
//OBTENGO TAREA A TRANSCODIFICAR
//
if (2 != count($argv)) exit(-1);
if (($id =intval($argv[1])) == 0)  exit(-1);

//OBTENGO TAREA
$trans = TranscodingPeer::retrievebyPk($id);

//CREO SCRIPT SI ES NECESARIO
$avs_file = null;
if(strlen($trans->getPerfil()->getPrescript())){
  //echo  "AVISYNTH" . $trans->getPerfil()->getPrescript() . "\n-------\n\n \n";
  //FALTA SUSTITUIR %1 PATH
  $avs_file = sfConfig::get('app_transcoder_path_tmp') . "/avs/" . $trans->getId()  . ".avs";
  file_put_contents($avs_file, str_replace('%1', $trans->getPathIniWin(), $trans->getPerfil()->getPrescript()));
}

//CREO LINEA DE EJECUCION
$linea_comandos = $trans->getBatAuto($avs_file);
echo $linea_comandos . " \n";

//INICIALIZO TIMESTART
$trans->setTimestart('now');
$trans->save();

//CREO DIRECTORIO
@mkdir(dirname($trans->getPathEnd()));

//EJECUTO
$ch = curl_init('http://' . $trans->getCpu()->getIp() . '/webserver.php'); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic " .  base64_encode("pumukit:PUMUKIT")));
curl_setopt ($ch, CURLOPT_POST, 1); 
curl_setopt ($ch, CURLOPT_POSTFIELDS, "ruta=$linea_comandos"); 

$var = curl_exec($ch); 
$error = curl_error($ch);

Propel::initialize();

//analizo archivo
try {
  $duration = FilePeer::getDuration($trans->getPathEnd());
}
catch (Exception $e) {
  $duration = 0;
}


//VEO SI HAY ERROR
if (TranscodingPeer::search_error($trans->getPerfil()->getApp(), $var, $trans->getDuration(), $duration)){
  $trans->setStatusId(3); 
  $trans->setDuration($duration);
  $cad_salida = "OK   -- ";
  //CREO ARCHIVO DE VIDEO
  if($trans->getMmId() != 0) $trans->createFile();
}else{
  $trans->setStatusId(-1); 
  $cad_salida = "ERROR-- ";
} 


//INICIALIZO TIMESTOP
$trans->setTimeend('now');
$trans->save();


//CREO LOG
//borra los logs
LogTranscodingPeer::act($trans);

$subject = $cad_salida;
$cad_salida .= 'Id Local: ' . $trans->getId() . ' Inicio: ' . $trans->getTimeini() . ' CPU Usada: ' . $trans->getCpu()->getIp() . ' Start: ' . $trans->getTimestart() . ' End: ' . $trans->getTimeend() . ' -- Perfil: ' . $trans->getPerfil()->getName() . ' Id Video: ' . $trans->getMmId() . ' Duration_ini: ' . $trans->getDuration() . ' Duration_end: ' . $duration . ' path_end: ' . $trans->getPathEnd() . "\n";
$cad_salida .= $linea_comandos;
$cad_salida .= $var . "\n";
$cad_salida .= $error . "\n";
$cad_salida .= "\n-------------------------------------------------------\n";
echo $cad_salida." \n";




//MANDO CORREO
if(eregi('^[\x20-\x2D\x2F-\x7E]+(\.[\x20-\x2D\x2F-\x7E]+)*@(([a-z0-9]([-a-z0-9]*[a-z0-9]+)?){1,63}\.)+[a-z0-9]{2,6}$',$trans->getEmail())){
  $mail = new sfMail();
  $mail->initialize();
  $mail->setMailer('sendmail');
  $mail->setCharset('utf-8');

  $mail->setSender('tv@uvigo.es', 'uvigoTv');
  $mail->setFrom('tv@uvigo.es', 'uvigoTv');
  $mail->addReplyTo('tv@uvigo.es');
  
  $mail->addAddress($trans->getEmail());
  if($cad_salida == "ERROR-- ") $mail->addAddress("rubenrua@uvigo.es");

  $mail->setSubject($subject . 'Tarea Finalizada');
  $mail->setBody('
Id: ' . $trans->getId() . '
Perfil: ' . $trans->getPerfil()->getName() . '
Estado: ' . $trans->getStatusId() . '
Fecha: ' . date('r') . '


------------------------------
-- BIN
------------------------------
' . $linea_comandos . '
------------------------------
-- OUT
------------------------------
' . $cad_salida . '
');

  $mail->send();



}


//ELIMINO ARCHIVOS TEMPORALES
//$trans->deleteTempFiles();

//ELIMINAR TRANSCODING
//$trans->delete();



//EJECUTO SIGUIENTE
TranscodingPeer::execNext();

