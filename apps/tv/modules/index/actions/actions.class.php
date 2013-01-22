<?php

/**
 * index actions.
 *
 * @package    fin
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class indexActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->getUser()->panNivelUno();

    $this->widgets = ElementWidgetPeer::doListJoinAll('IndexBody');
  }


  public function executeError404()
  {
    $this->template = TemplatePeer::get('error404', $this->getUser()->getCulture());
  }
}
