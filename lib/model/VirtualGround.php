<?php

/**
 * Subclass for representing a row from the 'virtual_ground' table.
 *
 * 
 *
 * @package lib.model
 */ 
class VirtualGround extends BaseVirtualGround
{
  public function getGrounds($gtype = null)
  {
    $c = new Criteria();
    $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());
    $c->addJoin(VirtualGroundRelationPeer::GROUND_ID, GroundPeer::ID);
    if ($gtype != null){
      $c->add(GroundPeer::GROUND_TYPE_ID, $gtype); 
    }

    return GroundPeer::doSelect($c);
  }

  public function getSerials()
  {
    $c = new Criteria();
    //$c->addJoin()
    $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());
    $c->addJoin(GroundMmPeer::GROUND_ID, VirtualGroundRelationPeer::GROUND_ID);
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);

    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->add(GroundPeer::GROUND_TYPE_ID, WidgetConstantPeer::get(10));

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->add(MmPeer::STATUS_ID, 0);
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);

    $c->setDistinct(true);

    //TODO Solo publicas

    return SerialPeer::doSelect($c);
  }


  public function countMms()
  {
    $c = new Criteria();
    //$c->addJoin()
    $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());
    $c->addJoin(GroundMmPeer::GROUND_ID, VirtualGroundRelationPeer::GROUND_ID);
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);

    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->add(GroundPeer::GROUND_TYPE_ID, WidgetConstantPeer::get(10));

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->setDistinct(true);

    //TODO Solo publicas

    return MmPeer::doCount($c);
  }



  /**
   * 
   * @access public
   */
  public function getRelationsId()
  {
    $c = new Criteria();

    $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());
    $c->addJoin(GroundPeer::ID, VirtualGroundRelationPeer::GROUND_ID);
    $c->clearSelectColumns()->addSelectColumn(GroundPeer::ID);

    $rs = BasePeer::doSelect($c);
    $ids = array();

    while($rs->next()) {
      $ids[] = $rs->getInt(1);
    }

    return $ids;
  }
}

sfPropelBehavior::add('VirtualGround', array('sortable'));