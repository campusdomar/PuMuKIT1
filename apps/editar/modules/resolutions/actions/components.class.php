<?php

/**
 * resolutions components.
 *
 * @package    fin
 * @subpackage resolutions
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class resolutionsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/resolution')){
      $this->resolution = ResolutionPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/resolution'));
      //$this->resolution->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->resolution);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(ResolutionPeer::ID);

  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/resolution');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/resolution') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/resolution');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_resolution_all = ResolutionPeer::doCount(new Criteria());
    $this->total_resolution = ResolutionPeer::doCount($cTotal);
    $this->total = ceil($this->total_resolution / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->resolutions = ResolutionPeer::doSelect($c);
  }
  
}
