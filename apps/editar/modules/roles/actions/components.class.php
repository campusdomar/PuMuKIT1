<?php

/**
 * roles components.
 *
 * @package    fin
 * @subpackage roles
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class rolesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/role')){
      $this->role = RolePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/role'));
      //$this->role->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->role);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(RolePeer::RANK);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/role');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/role') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/role');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_role_all = RolePeer::doCount(new Criteria());
    $this->total_role = RolePeer::doCount($cTotal);
    $this->total = ceil($this->total_role / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->roles = RolePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/role/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/role/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/role/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(RolePeer::ID, RoleI18nPeer::ID);
      $c->add(RoleI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(RoleI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }
  }

}
