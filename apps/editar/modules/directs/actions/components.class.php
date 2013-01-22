<?php

/**
 * directs components.
 *
 * @package    fin
 * @subpackage directs
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class directsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/direct')){
      $this->direct = DirectPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/direct'));
      //$this->direct->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->direct);
    }
  }

  public function executeList()
  {
    $limit  = 7;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(DirectPeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/direct');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/direct') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/direct');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }


    $this->total_direct = DirectPeer::doCount($cTotal);
    $this->total_direct_all = DirectPeer::doCount(new Criteria());
    $this->total = ceil($this->total_direct / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->directs = DirectPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/direct/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/direct/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/direct/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(DirectPeer::ID, DirectI18nPeer::ID);
      $c->add(DirectI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(DirectI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }

  }
}
