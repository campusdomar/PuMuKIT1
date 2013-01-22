<?php

/**
 * announces actions.
 *
 * @package    fin
 * @subpackage announces
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class announcesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	$this->announces = PubChannelPeer::getSerialAndMmAnnounces(1, $this->getUser()->getCulture(), 0);
    $this->getUser()->panNivelDos('Novedades', 'announces/index');
  }
}
