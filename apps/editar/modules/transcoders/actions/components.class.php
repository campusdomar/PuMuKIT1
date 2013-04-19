<?php

/**
 * cpus components.
 *
 * @package    fin
 * @subpackage cpus
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class transcodersComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/transcoder')){
      $this->transcoder = TranscodingPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/transcoder'));
      //$this->cpu->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->cpu);
    }
  }
  
  public function executeCpus()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(CpuPeer::ID);
    $this->cpus = CpuPeer::doSelect($c);
  }

  public function executeListpast()
  {
    $limit  = 6;
    $offset = 0;

    $c = new Criteria();
    $c->addDescendingOrderByColumn(TranscodingPeer::TIMEINI);
    $c->addAscendingOrderByColumn(TranscodingPeer::PRIORITY);
    $c->add(TranscodingPeer::STATUS_ID, array(0, 1), Criteria::IN);    
    
    $this->processFilters($c);
  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page_past', $this->getRequestParameter('page'), 'tv_admin/transcoder');
    }

    if ($this->getUser()->hasAttribute('page_past', 'tv_admin/transcoder') )
    {
      $this->page = $this->getUser()->getAttribute('page_past', null, 'tv_admin/transcoder');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_transcoder_all = TranscodingPeer::doCount(new Criteria());
    $this->total_transcoder = TranscodingPeer::doCount($cTotal);
    $this->total = ceil($this->total_transcoder / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page_past', 1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->transcoders = TranscodingPeer::doSelect($c);
  }


  public function executeListpresent()
  {
    $limit  = 6;
    $offset = 0;

    $c = new Criteria();
    $c->addDescendingOrderByColumn(TranscodingPeer::TIMEINI);
    $c->addDescendingOrderByColumn(TranscodingPeer::PRIORITY);
    $c->add(TranscodingPeer::STATUS_ID, array(2), Criteria::IN);    

    $this->processFilters($c);
  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page_present', $this->getRequestParameter('page'), 'tv_admin/transcoder');
    }

    if ($this->getUser()->hasAttribute('page_present', 'tv_admin/transcoder') )
    {
      $this->page = $this->getUser()->getAttribute('page_present', null, 'tv_admin/transcoder');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_transcoder_all = TranscodingPeer::doCount(new Criteria());
    $this->total_transcoder = TranscodingPeer::doCount($cTotal);
    $this->total = ceil($this->total_transcoder / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page_present', 1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->transcoders = TranscodingPeer::doSelect($c);
  }

  public function executeListfuture()
  {
    $limit  = 6;
    $offset = 0;

    $c = new Criteria();
    $c->addDescendingOrderByColumn(TranscodingPeer::TIMEINI);
    $c->addDescendingOrderByColumn(TranscodingPeer::ID);
    $c->add(TranscodingPeer::STATUS_ID, array(3, -1), Criteria::IN);
    
    $this->processFilters($c);
  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page_future', $this->getRequestParameter('page'), 'tv_admin/transcoder');
    }

    if ($this->getUser()->hasAttribute('page_future', 'tv_admin/transcoder') )
    {
      $this->page = $this->getUser()->getAttribute('page_future', null, 'tv_admin/transcoder');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_transcoder_all = TranscodingPeer::doCount(new Criteria());
    $this->total_transcoder = TranscodingPeer::doCount($cTotal);
    $this->total = ceil($this->total_transcoder / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page_future', 1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->transcoders = TranscodingPeer::doSelect($c);
  }
  
  
  
  protected function processFilters(Criteria $c)
  {
    if ($this->getRequest()->hasParameter('filter')){

      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/transcoders/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/transcoders/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/transcoders/filters');  

    //var_dump($filters);

    if (isset($filters['status'])){
      $criterion = $c->getCriterion(TranscodingPeer::STATUS_ID);
      $criterion->addAnd($c->getNewCriterion(TranscodingPeer::STATUS_ID, array_keys($filters['status']), Criteria::IN));
      $c->add($criterion);
    }
  }
}
