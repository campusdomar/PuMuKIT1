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
      $this->serials = $this->vcat->getSerials();      
      $this->objects_by_year = $this->groupObjectsByYear($this->serials);

    } else {

      if ($this->vcat->getEditorial1()) $cod = CategoryMmTimeframePeer::EDITORIAL1;
      if ($this->vcat->getEditorial2()) $cod = CategoryMmTimeframePeer::EDITORIAL2;
      $this->mms = CategoryMmTimeframePeer::doSelectDestacados($cod, true, null);
      $this->objects_by_year = $this->groupObjectsByYear($this->mms);
    }

    $this->setTemplate('display');
  }

// getCriteria is no longer needed as "decisiones editoriales" (editorial1 and editorial2)
// now depend on CategoryMmTimeframePeer logic.

/**
 * @param $objects resultset of serials or mms
 * @return array $objects_by_year [4_digit_year] = array (serials or mms)
 */
  private function groupObjectsByYear($objects)
  {
    $objects_by_year = array();

    foreach($objects as $object){
      if (!array_key_exists($object->getPublicDate('Y'), $objects_by_year)) {
        $objects_by_year[$object->getPublicDate('Y')] = array();
      }
      $objects_by_year[$object->getPublicDate('Y')][] = $object;
    }

    return $objects_by_year;
  }
}
