<?php
 /**
 * ViewsLog (class)
 *
 * Clase para guardar un log personalizado.
 * Se usa para guardar las vistas de un video.
 *
 * Uso la idea original de jonsegador.com pero usando las clases
 * de symfony 1.0 como muestra
 * www.symfonybr.com/2008/05/08/logando-o-tempo-de-execucao-de-um-script-com-sffilelogger/
 *
 */
class ViewsLog{
  static public function newLog($message)
  {
    $logFile = sfConfig::get("sf_log_dir").'/views.log';
   
    $logger = new myFileLogger();
    $logger->initialize(array('file' => $logFile));
    $logger->log("$message", 0, "Info");

    // El siguiente codigo (jonsegador) no funciona en sf 1.0 (no existe método info)
        // $logFile = sfConfig::get('sf_log_dir').'/ViewsLog.log';
        // $custom_log = new sfFileLogger(new sfEventDispatcher(), array('file' => $logFile));
        // $custom_log->info($message);

  }
 
  static public function logThisView(sfwebRequest $request)
  {

    $ip        = $_SERVER['REMOTE_ADDR']; //Cambiar por HTTP_X_FORWARDED_FOR si se usa un proxy. Procesarla si se usan varios.
    $userid    = "- -";
    // hyphen  = RFC 1413 identity (unreliable);
    // userid: see http://httpd.apache.org/docs/2.2/logs.html#common
    $time      = date("[j/M/Y:G:i:s O]");
    $req       = "\"".$request->getMethodName()." ".$request->getURI()." ".$_SERVER['SERVER_PROTOCOL']."\"";
    $status    = (isset($_SERVER['REDIRECT_STATUS'])) ? $_SERVER['REDIRECT_STATUS'] : "-";
    // sf getStatusCode method depends on sfWebResponse
    $size      = "-";                        // not implemented.
    // There is a file (pumukit) object with a size value.
    $referer   = "\"".$_SERVER['HTTP_REFERER']."\"";
    $userAgent = "\"".$_SERVER['HTTP_USER_AGENT']."\"";
    // use the following statement to get all the request information
    // $kk = print_r($request,true)
   
    $combinedLogFormat = "$ip $userid $time $req $status $size $referer $userAgent";
    ViewsLog::newLog($combinedLogFormat);
   
  }
}
