<?php
/**
 * MODULO EVENTS COMPONENTS. 
 * Modulo de configuracion de los noticias y eventos que aparecen en el portal web.
 *
 * @package    pumukit
 * @subpackage events
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 **/
class eventsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/event')){
      $this->event = EventPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/event'));
      //$this->event->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->event);
    }
  }

  public function executeArray()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addDescendingOrderByColumn(EventPeer::DATE);
    $c->addAscendingOrderByColumn(EventPeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/event');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/event') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/event');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_event_all = EventPeer::doCount(new Criteria());
    $this->total_event = EventPeer::doCount($cTotal);
    $this->total = ceil($this->total_event / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->events = EventPeer::doSelect($c);
  }

  public function executeCalendar()
  {
    $this->total_event_all = EventPeer::doCount(new Criteria());


    if ($this->getRequestParameter('mes') == "mas")
    {
      $m = $this->getUser()->getAttribute('mes', date('m'), 'tv_admin/event');
      $y = $this->getUser()->getAttribute('ano', date('Y'), 'tv_admin/event');
      $fecha_cambiada = mktime(0,0,0,$m+1,1,$y);
      $this->getUser()->setAttribute('ano', date("Y", $fecha_cambiada), 'tv_admin/event');
      $this->getUser()->setAttribute('mes', date("m", $fecha_cambiada), 'tv_admin/event');
    }elseif ($this->getRequestParameter('mes') == "menos"){
      $m = $this->getUser()->getAttribute('mes', date('m'), 'tv_admin/event');
      $y = $this->getUser()->getAttribute('ano', date('Y'), 'tv_admin/event');
      $fecha_cambiada = mktime(0,0,0,$m-1,1,$y);
      $this->getUser()->setAttribute('ano', date("Y", $fecha_cambiada), 'tv_admin/event');
      $this->getUser()->setAttribute('mes', date("m", $fecha_cambiada), 'tv_admin/event');
    }elseif ($this->getRequestParameter('mes') == "hoy"){
      $this->getUser()->setAttribute('ano', date("Y"), 'tv_admin/event');
      $this->getUser()->setAttribute('mes', date("m"), 'tv_admin/event');
    }


    $this->m = $this->getUser()->getAttribute('mes', date('m'), 'tv_admin/event');
    $this->y = $this->getUser()->getAttribute('ano', date('Y'), 'tv_admin/event');
    $this->cal = calendar::generate_array($this->m, $this->y);
  }



  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/event/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/event/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/event/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->add(EventPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
    }

    if (isset($filters['date'])){
      if (isset($filters['date']['from']) && $filters['date']['from'] !== ''){
        list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['from'], $this->getUser()->getCulture());
        $criterion = $c->getNewCriterion(EventPeer::DATE, "$y-$m-$d", Criteria::GREATER_EQUAL);
      }

      if (isset($filters['date']['to']) && $filters['date']['to'] !== ''){
        if (isset($criterion)){
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion->addAnd($c->getNewCriterion(EventPeer::DATE, "$y-$m-$d", Criteria::LESS_EQUAL));
        }else{
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion = $c->getNewCriterion(EventPeer::DATE, "$y-$m-$d", Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
        {
          $c->add($criterion);
        }
    }


  }
}
