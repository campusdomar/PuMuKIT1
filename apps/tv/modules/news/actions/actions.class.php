<?php

/**
 * news actions.
 *
 * @package    fin
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class newsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->notices = NoticePeer::doListWithI18n($this->getUser()->getCulture());
    $this->getUser()->panNivelDos('Noticias', 'news/index');
  }
}
