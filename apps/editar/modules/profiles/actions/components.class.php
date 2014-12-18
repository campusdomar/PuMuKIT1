<?php

/**
 * profiles components.
 *
 * @package    fin
 * @subpackage profiles
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class profilesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/profile')){
      $this->profile = PerfilPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/profile'));
      //$this->profile->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->profile);
    }
  }

  public function executeList()
  {
    $limit  = 35;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);

  
    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/profile');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/profile') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/profile');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_profile_all = PerfilPeer::doCount(new Criteria());
    $this->total_profile = PerfilPeer::doCount($cTotal);
    $this->total = ceil($this->total_profile / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->profiles = PerfilPeer::doSelectJoinStreamserver($c);
  }
  
}
