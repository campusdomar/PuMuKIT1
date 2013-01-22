<?php

/**
 * cpus components.
 *
 * @package    fin
 * @subpackage cpus
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class cpusComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/cpu')){
      $this->cpu = CpuPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/cpu'));
      //$this->cpu->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->cpu);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(CpuPeer::ID);

  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/cpu');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/cpu') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/cpu');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_cpu_all = CpuPeer::doCount(new Criteria());
    $this->total_cpu = CpuPeer::doCount($cTotal);
    $this->total = ceil($this->total_cpu / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->cpus = CpuPeer::doSelect($c);
  }
  
}
