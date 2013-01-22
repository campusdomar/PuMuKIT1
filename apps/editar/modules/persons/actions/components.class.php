<?php
/**
 * MODULO PERSONS COMPONENETS. 
 * Modulo de administracion de las personas que estan asociadas a algun
 * objeto multimedia del catalogo. Esta relacion se realiza a traves del
 * un rol. Las tabla personas almacena los cargos por lo que una persona
 * con dos cargos diferentes tendra dos entrasa en la base de datos.
 *
 * @package    pumukit
 * @subpackage index
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class personsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/person')){
      $this->person = PersonPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/person'));
      //$this->person->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->person);
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
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/person');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/person') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/person');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_person_all = PersonPeer::doCount(new Criteria());
    $this->total_person = PersonPeer::doCount($cTotal);
    $this->total = ceil($this->total_person / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->persons = PersonPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }



  public function executeListrelation()
  {
    $this->persons = PersonPeer::doList($this->mm->getId(), $this->role->getId(), $this->getUser()->getCulture());

  }


  public function executeListrelationtemplate()
  {
    $this->persons = PersonPeer::doListTemplate($this->mm->getId(), $this->role->getId(), $this->getUser()->getCulture());
  }

  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/person/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/person/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/person/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->add(PersonPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);
    }

    if (isset($filters['other']) && $filters['other'] !== ''){
      $c->addJoin(PersonPeer::ID, PersonI18nPeer::ID);
      $criterion = $c->getNewCriterion(PersonI18nPeer::POST, '%' . $filters['other']. '%', Criteria::LIKE);
      $criterion->addOr($c->getNewCriterion(PersonI18nPeer::FIRM, '%' . $filters['other']. '%', Criteria::LIKE));
      $criterion->addOr($c->getNewCriterion(PersonI18nPeer::BIO, '%' . $filters['other']. '%', Criteria::LIKE));
      $c->addAnd($criterion);
      $c->add(PersonI18nPeer::CULTURE, $this->getUser()->getCulture());
    }


    if (isset($filters['vowel']) && $filters['vowel'] !== ''){
      $criterion= $c->getCriterion(PersonPeer::NAME);
      if($criterion){
        $criterion->addAnd($c->getNewCriterion(PersonPeer::NAME, $filters['vowel']. '%', Criteria::LIKE));
        $c->add($criterion);
      }else{
        $c->add(PersonPeer::NAME, $filters['vowel']. '%', Criteria::LIKE);
      }
    }
  }

  protected function processSort($c)
  {
    if ($this->getRequestParameter('sort')){
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'tv_admin/person');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'tv_admin/person');
    }

    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'tv_admin/person')){
      $sort_column = PersonPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', 'asc', 'tv_admin/person') == 'asc'){
	$c->addAscendingOrderByColumn($sort_column);
      }else{
	$c->addDescendingOrderByColumn($sort_column);
      }
    }
  }
}
