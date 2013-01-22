<?php
/**
 * broadcasts components.
 *
 * @package    fin
 * @subpackage broadcasts
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class broadcastsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/broadcast')){
      $this->broadcast = BroadcastPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/broadcast'));
      //$this->broadcast->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->broadcast);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(BroadcastPeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/broadcast');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/broadcast') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/broadcast');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_broadcast_all = BroadcastPeer::doCount(new Criteria());
    $this->total_broadcast = BroadcastPeer::doCount($cTotal);
    $this->total = ceil($this->total_broadcast / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->broadcasts = BroadcastPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/broadcast/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/broadcast/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/broadcast/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->add(BroadcastPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
    }

  }
}
