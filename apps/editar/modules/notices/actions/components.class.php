<?php
/**
 * MODULO NOTICES COMPONENTS. 
 * Modulo de configuracion de los noticias y eventos que aparecen en el portal web.
 *
 * @package    pumukit
 * @subpackage notices
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 **/
class noticesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/notice')){
      $this->notice = NoticePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/notice'));
      //$this->notice->setCulture( $this->getUser()->getCulture() );
      //$this->forward404Unless($this->notice);
    }
  }

  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addDescendingOrderByColumn(NoticePeer::DATE);
    $c->addAscendingOrderByColumn(NoticePeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/notice');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/notice') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/notice');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_notice_all = NoticePeer::doCount(new Criteria());
    $this->total_notice = NoticePeer::doCount($cTotal);
    $this->total = ceil($this->total_notice / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->notices = NoticePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }


  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/notice/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/notice/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/notice/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->addJoin(NoticePeer::ID, NoticeI18nPeer::ID);
      $c->add(NoticeI18nPeer::TEXT, '%' . $filters['name']. '%', Criteria::LIKE);
      $c->add(NoticeI18nPeer::CULTURE, $this->getUser()->getCulture() );

    }

    if (isset($filters['date'])){
      if (isset($filters['date']['from']) && $filters['date']['from'] !== ''){
        list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['from'], $this->getUser()->getCulture());
        $criterion = $c->getNewCriterion(NoticePeer::DATE, "$y-$m-$d", Criteria::GREATER_EQUAL);
      }

      if (isset($filters['date']['to']) && $filters['date']['to'] !== ''){
        if (isset($criterion)){
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion->addAnd($c->getNewCriterion(NoticePeer::DATE, "$y-$m-$d", Criteria::LESS_EQUAL));
        }else{
          list($d, $m, $y) = sfI18N::getDateForCulture($filters['date']['to'], $this->getUser()->getCulture());
          $criterion = $c->getNewCriterion(NoticePeer::DATE, "$y-$m-$d", Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
        {
          $c->add($criterion);
        }
    }


  }
}
