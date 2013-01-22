<?php

/**
 * mattypes components.
 *
 * @package    fin
 * @subpackage mattypes
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mattypesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/mattype')){
      $this->mattype = MatTypePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/mattype'));
      //$this->mattype->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->mattype);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(MatTypePeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/mattype');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/mattype') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/mattype');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_mattype_all = MatTypePeer::doCount(new Criteria());
    $this->total_mattype = MatTypePeer::doCount($cTotal);
    $this->total = ceil($this->total_mattype / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->mattypes = MatTypePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/mattype/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/mattype/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/mattype/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(MatTypePeer::ID, MatTypeI18nPeer::ID);
      $c->add(MatTypeI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(MatTypeI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }

  }
}
