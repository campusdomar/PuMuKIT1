<?php

/**
 * serials components.
 *
 * @package    fin
 * @subpackage serials
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class serialsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/serial'))
    {
      $this->serial = SerialPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/serial'));
    }
  }

  public function executeList()
  {
    $limit  = 11;
    $offset = 0;

    $c = new Criteria();

    $this->processSort($c);
    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/serial');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/serial') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/serial');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_serial_all = SerialPeer::doCount(new Criteria());
    $this->total_serial = SerialPeer::doCount($cTotal);
    $this->total = ceil($this->total_serial / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->serials = SerialPeer::doList($c, $this->getUser()->getCulture());
    //$this->serials = SerialPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  public function executeEdit()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/serial'))
    {
      $this->serial = SerialPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/serial'));
    }
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }

  protected function processFilters(Criteria $c)
  {
    $c->setDistinct(true);
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/serial/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/serial/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/serial/filters');

    if (isset($filters['title']) && $filters['title'] !== ''){
      if(0 != intval($filters['title'])){
        $c->add(SerialPeer::ID, intval($filters['title']));
      }else{
        $c->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
	$c->add(SerialI18nPeer::TITLE, '%' . str_replace(' ', '%', $filters['title']). '%', Criteria::LIKE);
        $c->add(SerialI18nPeer::CULTURE, $this->getUser()->getCulture());
      }
    }

    if (isset($filters['person']) && $filters['person'] !== ''){
      $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
      $c->addJoin(MmPeer::ID, MmPersonPeer::MM_ID);
      $c->addJoin(PersonPeer::ID, MmPersonPeer::PERSON_ID);
      $c->add(PersonPeer::NAME, '%' . $filters['person']. '%', Criteria::LIKE);
      $c->setDistinct(true);
    }

    if (isset($filters['place']) && $filters['place'] != 0){
      $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
      $c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
      $c->add(PrecinctPeer::PLACE_ID, $filters['place']);
    }

    if (isset($filters['serialtype'])){
      $c->add(SerialPeer::SERIAL_TYPE_ID, array_keys($filters['serialtype']), Criteria::IN);
    }


    if (isset($filters['announce']) && ($filters['announce'] === 'true' || $filters['announce'] === 'false')){
      $c->add(SerialPeer::ANNOUNCE, $filters['announce'] === 'true');
    }

    if (isset($filters['status'])&&($filters['status'] != 'diff')){
      $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
      $c->add(MmPeer::STATUS_ID, $filters['status']);
    }

    if (isset($filters['broadcast'])){
      $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
      $c->add(MmPeer::BROADCAST_ID, array_keys($filters['broadcast']), Criteria::IN);
    }

    if (isset($filters['date'])){
      if (isset($filters['date']['from']) && $filters['date']['from'] !== ''){
        list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['from'], $this->getUser()->getCulture());
        $criterion = $c->getNewCriterion(MmPeer::RECORDDATE, "$y-$m-$d", Criteria::GREATER_EQUAL);
      }

      if (isset($filters['date']['to']) && $filters['date']['to'] !== ''){
        if (isset($criterion)){
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion->addAnd($c->getNewCriterion(MmPeer::RECORDDATE, "$y-$m-$d", Criteria::LESS_EQUAL));
        }else{
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion = $c->getNewCriterion(MmPeer::RECORDDATE, "$y-$m-$d", Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion)){
	$c->add($criterion);
	$c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
      }
    }
  }

  protected function processSort(Criteria $c)
  {
    if ($this->getRequestParameter('sort')){
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'tv_admin/serial');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'tv_admin/serial');
    }


    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'tv_admin/serial')){
      try{
	$sort_column = SerialPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      }catch(Exception $e){
	try{
	  $sort_column = SerialI18nPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
	}catch(Exception $e){
	}
      }
      if ($this->getUser()->getAttribute('type', 'asc', 'tv_admin/serial') == 'asc'){
	$c->addAscendingOrderByColumn($sort_column);
      }else{
	$c->addDescendingOrderByColumn($sort_column);
      }
    }
  }
}
