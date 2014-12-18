<?php

/**
 * categories actions.
 *
 * @package    pumukituvigo
 * @subpackage categories
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoriesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

    $this->vcat = VirtualGroundPeer::retrieveByPKWithI18n($this->getRequestParameter('id'), $this->getUser()->getCulture());
    $this->forward404Unless($this->vcat);

    $this->getUser()->panNivelDos($this->vcat->getName(), 'categories/index?id=' . $this->getRequestParameter('id'));

    if ($this->vcat->getOther()){
      $this->sub_cats = $this->vcat->getGrounds($this->vcat->getGroundTypeId());
      $this->setTemplate('multidisplay');
    }else{

      $c = $this->getCriteria();
      if ($this->vcat->getEditorial1())
	$c->add(MmPeer::EDITORIAL1, 1);
      if ($this->vcat->getEditorial2())
	$c->add(MmPeer::EDITORIAL2, 1);
      if ($this->vcat->getEditorial3())
	$c->add(MmPeer::EDITORIAL3, 1);

      $c->clearOrderByColumns();
      $c->addAscendingOrderByColumn(SerialI18nPeer::LINE2);

      $this->serials = SerialPeer::doSelectWithI18n($c);
      $this->setTemplate('display');
    }
  }



  private function getCriteria(){
    $c = new Criteria();
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);

    //FIXME Filtar bien
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c, array($this->getRequestParameter('broadcast', 'pub')));
    if ($this->hasRequestParameter('search')){
      SerialPeer::addSeachCriteria($c, $this->getRequestParameter('search'), $this->getUser()->getCulture());
    }

    $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);

    return $c;
  }

}
