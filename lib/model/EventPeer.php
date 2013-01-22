<?php

/**
 * Subclass for performing query and update operations on the 'event' table.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPeer extends BaseEventPeer
{
  /**
   *
   */
  static public function getByDate($y, $m, $d){
    $c = new Criteria();
    $c->add(EventPeer::DATE, mktime(0,0,0,$m, $d, $y), Criteria::GREATER_EQUAL);
    $c->addAnd(EventPeer::DATE, mktime(23, 59, 59, $m, $d, $y), Criteria::LESS_EQUAL);

    return EventPeer::doSelect($c);
  }



 /**
   *
   *
   */
  static public function getFuture($limit = null){
    $c = new Criteria();
    $c->add(EventPeer::DATE, date('Y-m-d'), Criteria::GREATER_EQUAL);
    $c->add(EventPeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(EventPeer::DATE);

    if($limit != null){
      $c->setLimit($limit);
    }
    
    return EventPeer::doSelect($c);
  }
}
