<?php

/**
 * streamservs components.
 *
 * @package    fin
 * @subpackage streamservs
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class streamservsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/streamserv')){
      $this->streamserv = StreamserverPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/streamserv'));
      //$this->streamserv->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->streamserv);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(StreamserverPeer::ID);

  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/streamserv');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/streamserv') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/streamserv');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_streamserv_all = StreamserverPeer::doCount(new Criteria());
    $this->total_streamserv = StreamserverPeer::doCount($cTotal);
    $this->total = ceil($this->total_streamserv / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->streamservs = StreamserverPeer::doSelect($c);
  }
  
}
