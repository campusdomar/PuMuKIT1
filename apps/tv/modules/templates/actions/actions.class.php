<?php

/**
 * templates actions.
 *
 * @package    fin
 * @subpackage templates
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class templatesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->template = TemplatePeer::get($this->getRequestParameter('temp'), $this->getUser()->getCulture());
    $this->forward404Unless($this->template);


    $this->getUser()->panNivelDos($this->template->getName(), 'templates/index?temp=' . $this->template->getId());
  }
}
