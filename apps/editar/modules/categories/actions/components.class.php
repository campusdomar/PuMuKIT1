<?php

/**
 * categories components.
 *
 * @package    fin
 * @subpackage categories
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoriesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/category')){
      $this->category = CategoryPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/category'));
      //$this->category->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->category);
    }
  }

  public function executeList()
  {
    $aux = CategoryPeer::buildTreeArray();
    $this->categories = $aux[0][CategoryPeer::TREE_ARRAY_CHILDREN];
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/category/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/category/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/category/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(CategoryPeer::ID, CategoryI18nPeer::ID);
      $c->add(CategoryI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(CategoryI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }
  }

}
