<?php

/**
 * serialtypes components.
 *
 * @package    fin
 * @subpackage serialtypes
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class serialtypesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/serialtype')){
      $this->serialtype = SerialTypePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/serialtype'));
      //$this->serialtype->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->serialtype);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(SerialTypePeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/serialtype');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/serialtype') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/serialtype');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_serialtype_all = SerialTypePeer::doCount(new Criteria());
    $this->total_serialtype = SerialTypePeer::doCount($cTotal);
    $this->total = ceil($this->total_serialtype / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->serialtypes = SerialTypePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/serialtype/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/serialtype/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/serialtype/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(SerialTypePeer::ID, SerialTypeI18nPeer::ID);
      $c->add(SerialTypeI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(SerialTypeI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }
  }
   

  public function executeNube(){
    $counts = array();
    $tags = SerialTypePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
    foreach($tags as $tag){
      $counts[] = array($tag, $tag->countSerials() / 3);
    }
    
    $this->tags = $counts;
  }

}
