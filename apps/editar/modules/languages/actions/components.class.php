<?php

/**
 * languages components.
 *
 * @package    fin
 * @subpackage languages
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class languagesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/language')){
      $this->language = LanguagePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/language'));
      //$this->language->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->language);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(LanguagePeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/language');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/language') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/language');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_language_all = LanguagePeer::doCount(new Criteria());
    $this->total_language = LanguagePeer::doCount($cTotal);
    $this->total = ceil($this->total_language / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->languages = LanguagePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/language/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/language/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/language/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(LanguagePeer::ID, LanguageI18nPeer::ID);
      $c->add(LanguageI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(LanguageI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }

  }
}
