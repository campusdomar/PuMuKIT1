<?php

/**
 * Módulo timeframes components.
 *
 * @package    pumukit
 * @subpackage timeframes
 * @author     
 * @version    
 */
class timeframesComponents extends sfComponents
{
    /**
     * Executes index component
     *
     */

    // public function executePreview()
    // {
    //     if ($this->getUser()->hasAttribute('id', 'tv_admin/timeframes')){
    //         $this->timeframe = CategoryMmTimeframePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/timeframes'));
    //         //$this->timeframe->setCulture( $this->getUser()->getCulture() );
    //         //$this->forward404Unless($this->timeframe);
    //     }
    // }

    public function executeList()
    {
        $limit  = 15;
        $offset = 0;

        $c = new Criteria();
        $c->addDescendingOrderByColumn(CategoryMmTimeframePeer::TIMESTART);

        $this->processFilters($c);

        $cTotal = clone $c;

        if ($this->hasRequestParameter('page'))
        {
            $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/timeframes');
        }

        if ($this->getUser()->hasAttribute('page', 'tv_admin/timeframes') )
        {
            $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/timeframes');
            $offset = ($this->page - 1) * $limit;
            $c->setLimit($limit);
            $c->setOffset($offset);
        }

        $this->total_timeframe_all = CategoryMmTimeframePeer::doCount(new Criteria());
        $this->total_timeframe = CategoryMmTimeframePeer::doCount($cTotal);
        $this->total = ceil($this->total_timeframe / $limit); 

        if ($this->total < $this->page)
        {
            $this->getUser()->setAttribute('page',1);
            $this->page = 1;
            $c->setOffset(0);
        }

        
        $this->timeframes = CategoryMmTimeframePeer::doSelect($c);
    }


    protected function processFilters($c)
    {
        if ($this->getRequest()->hasParameter('filter')){
            $filters = $this->getRequestParameter('filters');

            $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/timeframes/filters');
            $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/timeframes/filters');
        }

        $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/timeframes/filters');

        if (isset($filters['description']) && $filters['description'] !== ''){
            $c->add(CategoryMmTimeframePeer::DESCRIPTION, '%' . $filters['description']. '%', Criteria::LIKE);
        }
    }

}
