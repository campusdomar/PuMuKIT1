<?php
/**
 * MODULO GROUND COMPONENTS. 
 * Modulo de administracion para las areas de conocimiento y sus tipos. Es decir 
 * las categorias con sus dominios
 *
 * @package    pumukit
 * @subpackage ground
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class groundsComponents extends sfComponents
{
  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/ground')){
      $this->ground = GroundPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/ground'));
      //$this->ground->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->ground);
    }
  }

  public function executeList()
  {
    $limit  = 9;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    $c->add(GroundPeer::GROUND_TYPE_ID, $this->type);


    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/ground');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/ground') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/ground');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_ground_all = GroundPeer::doCount(new Criteria());
    $this->total_ground = GroundPeer::doCount($cTotal);
    $this->total = ceil($this->total_ground / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->grounds = GroundPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/ground/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/ground/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/ground/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(GroundPeer::ID, GroundI18nPeer::ID);
      $c->add(GroundI18nPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(GroundI18nPeer::CULTURE, $this->getUser()->getCulture() );
    }

  }


  public function executeRecomendationlist()
  {
    $this->function = false;
    if ($this->getRequestParameter('action') == 'addGround'){
      $recomended = GroundPeer::doSelectRelationsWithI18n($this->ground_id, $this->mm->getCulture());
      $included = $this->mm->getGroundsWithI18n();
      $this->grounds = array_diff($recomended, $included->getRawValue());
      if (sizeof($this->grounds)) $this->function = 'incluir';
    }elseif($this->getRequestParameter('action') == 'deleteGround'){
      $recomended = GroundPeer::doSelectRelationsWithI18n($this->ground_id, $this->mm->getCulture());
      $included = $this->mm->getGroundsWithI18n();
      $this->grounds = array_intersect($recomended, $included->getRawValue());
      if (sizeof($this->grounds)) $this->function = 'eliminar';
    }
  }
}
