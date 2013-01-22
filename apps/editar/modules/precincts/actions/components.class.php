<?php
/**
 * MODULO PRECINCTS COMPONENTS. 
 * Pseudomodulo con las acciones de recintos llamadas desde el modulo
 * de lugares.
 *
 * @package    pumukit
 * @subpackage precincts
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class precinctsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/precinct')){
      $this->precinct = PrecinctPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/precinct'));
      //$this->place->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->place);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->add(PrecinctPeer::PLACE_ID, $this->getUser()->getAttribute('place', $this->getRequestParameter('place', 1)));

    //$this->processSort($c);
    //$this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/precinct');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/precinct') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/precinct');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_precinct_all = PrecinctPeer::doCount(new Criteria());
    $this->total_precinct = PrecinctPeer::doCount($cTotal);
    $this->total = ceil($this->total_precinct / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->precincts = PrecinctPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }

}