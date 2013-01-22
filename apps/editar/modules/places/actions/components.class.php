<?php
/**
 * MODULO PLACE COMPONENTS
 * Modulo de administracion de las lugares donde se graban los 
 * objetos multimedia.
 *
 * @package    pumukit
 * @subpackage places
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class placesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/place')){
      $this->place = PlacePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/place'));
      //$this->place->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->place);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();

    $this->processSort($c);
    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/place');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/place') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/place');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_place_all = PlacePeer::doCount(new Criteria());
    $this->total_place = PlacePeer::doCount($cTotal);
    $this->total = ceil($this->total_place / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->places = PlacePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processSort($c)
  {
    if ($this->getRequestParameter('sort')){
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'tv_admin/place');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'tv_admin/place');
    }

    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'tv_admin/place')){
      $sort_column = PlaceI18nPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', 'asc', 'tv_admin/place') == 'asc'){
	$c->addAscendingOrderByColumn($sort_column);
      }else{
	$c->addDescendingOrderByColumn($sort_column);
      }
    }
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/place/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/place/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/place/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->add(PlaceI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->addJoin(PlacePeer::ID, PlaceI18nPeer::ID);
      $c->add(PlaceI18nPeer::CULTURE, $this->getUser()->getCulture());
    }

    if (isset($filters['address']) && $filters['address'] !== ''){
      $c->add(PlaceI18nPeer::ADDRESS, '%' . $filters['address']. '%', Criteria::LIKE);
      $c->addJoin(PlacePeer::ID, PlaceI18nPeer::ID);
      $c->add(PlaceI18nPeer::CULTURE, $this->getUser()->getCulture());
    }

  }
}
