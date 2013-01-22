<?php

/**
 * genres components.
 *
 * @package    fin
 * @subpackage genres
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class genresComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/genre')){
      $this->genre = GenrePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/genre'));
      //$this->genre->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->genre);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(GenreI18nPeer::NAME);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/genre');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/genre') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/genre');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_genre_all = GenrePeer::doCount(new Criteria());
    $this->total_genre = GenrePeer::doCount($cTotal);
    $this->total = ceil($this->total_genre / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->genres = GenrePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/genre/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/genre/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/genre/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(GenrePeer::ID, GenreI18nPeer::ID);
      $c->add(GenreI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(GenreI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }

  }
}
