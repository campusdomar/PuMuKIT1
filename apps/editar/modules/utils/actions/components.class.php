<?php

/**
 * utils components.
 *
 * @package    fin
 * @subpackage utils
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class utilsComponents extends sfComponents
{
  /**
   * Utilidad para generar la barras de widgets (laterales y centrales).
   *
   */
  public function executeBar()
  {
    $this->widgets = ElementWidgetPeer::doListJoinAll($this->bar);
  }
}

