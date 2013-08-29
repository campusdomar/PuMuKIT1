<?php

/**
 * File actions:
 *  * Comprueba difusión del video
 *  * Incrementa numero de visitas
 *  * 302 a la esencia del vídeo.
 *
 * @package    pumukitvigo
 * @subpackage file
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class fileActions extends sfActions
{
    /**
     * Executes index action
     *
     */
    public function executeIndex()
    {
        $seek_parameter = "start";

    $request = $this->getRequest();

        // RETRIEVE OBJECT
        if ($this->hasRequestParameter('mm_id')) {
            $mm = MmPeer::retrieveByPK($this->getRequestParameter('mm_id'));
            $this->forward404Unless($mm);

            $file = $mm->getFirstPublicFile();
        } else {
            $file = FilePeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($file);

            $mm = $file->getMmWithI18n();
        }

        // CHECK STATUS
    $status = array(MmPeer::STATUS_NORMAL, MmPeer::STATUS_HIDE);
    $this->forward404Unless($file);
    $this->forward404If($file->isMaster());
    if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin')) {
        $status[] = MmPeer::STATUS_BLOQ;
    } else {
        $this->forward404Unless($mm->hasPubChannelId(1));
        $this->forward404Unless($file->getDisplay());
    }

    $this->forward404Unless(in_array($mm->getStatusId(), $status));
    

    // INC LOGS
    $exists_range = array_key_exists('HTTP_RANGE', $_SERVER);
    $exists_start = array_key_exists('start', $_GET);
    
    if(( ($exists_range) || (!$exists_start) ) && ( (!$exists_range) || ($_SERVER['HTTP_RANGE'] == "bytes=0-") )) {
      $file->incNumView();
      ViewsLog::logThisView($request);
      //TODO no usar $_SERVER
      LogFilePeer::act( $file->getId(), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $this->getRequest()->getUri() );
    }
    
    // REDIRECT
    $this->getController()->redirect($file->getUrl() . "?" . http_build_query($_GET), 0);
    throw new sfStopException();
    }
}
