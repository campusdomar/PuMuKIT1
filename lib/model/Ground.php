<?php

/**
 * Subclass for representing a row from the 'ground' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Ground extends BaseGround
{
  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return $this->getName();
  }



  public function getSerials()
  {
    $c = new Criteria();
    //$c->addJoin()
    $c->add(GroundMmPeer::GROUND_ID, $this->getId());
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->add(MmPeer::STATUS_ID, 0);
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);

    $c->setDistinct(true);

    //TODO Solo publicas

    return SerialPeer::doSelect($c);
  }


  public function getMms()
  {
    $c = new Criteria();
    //$c->addJoin()
    $c->add(GroundMmPeer::GROUND_ID, $this->getId());
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->setDistinct(true);

    //TODO Solo publicas

    return MmPeer::doSelect($c);
  }


  public function countMms()
  {
    $c = new Criteria();
    //$c->addJoin()
    $c->add(GroundMmPeer::GROUND_ID, $this->getId());
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->setDistinct(true);

    //TODO Solo publicas

    return MmPeer::doCount($c);
  }




  /**
   * Devuelve la director del area  de conocimento especifica
   * 
   * @access public
   */
  public function getDirectriz()
  {
    $dir = false;
    if (self::getCod() === '110000') $dir='Enseñanzas Técnicas';
    if (self::getCod() === '120000') $dir='Enseñanzas Técnicas';
    if (self::getCod() === '210000') $dir='Enseñanzas Técnicas';
    if (self::getCod() === '220000') $dir='Ciencias Experimentales';
    if (self::getCod() === '230000') $dir='Ciencias Experimentales';
    if (self::getCod() === '240000') $dir='Ciencias de la Salud';
    if (self::getCod() === '250000') $dir='Ciencias Experimentales';
    if (self::getCod() === '310000') $dir='Ciencias Experimentales';
    if (self::getCod() === '320000') $dir='Ciencias de la Salud';
    if (self::getCod() === '330000') $dir='Enseñanzas Técnicas';
    if (self::getCod() === '510000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '520000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '530000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '540000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '550000') $dir='Humanidades';
    if (self::getCod() === '560000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '570000') $dir='Humanidades';
    if (self::getCod() === '580000') $dir='Humanidades';
    if (self::getCod() === '590000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '610000') $dir='Ciencias de la Salud';
    if (self::getCod() === '620000') $dir='Humanidades';
    if (self::getCod() === '630000') $dir='Ciencias Sociales y Jurídicas';
    if (self::getCod() === '710000') $dir='Humanidades';
    if (self::getCod() === '720000') $dir='Humanidades';
    return $dir;
  }

  /**
   * 
   * @access public
   */
  public function getRelationsId()
  {
    $c = new Criteria();

    $c->addJoin(GroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
    $c->addJoin(RelationGroundPeer::TWO_ID, GroundPeer::ID);
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->add(RelationGroundPeer::ONE_ID, $this->getId());
    $c->clearSelectColumns()->addSelectColumn(GroundPeer::ID);

    $rs = BasePeer::doSelect($c);
    $ids = array();

    while($rs->next()) {
      $ids[] = $rs->get(1);
    }
    return $ids;
  }

  /**
   * Ver GroundPeer::doSelectRelations
   *
   * 
   * @access public
   */
  public function getRelations()
  {
    $c = new Criteria();
    $c->addJoin(GroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
    $c->addJoin(RelationGroundPeer::TWO_ID, GroundPeer::ID);
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->add(RelationGroundPeer::ONE_ID, $this->getId());

    return GroundPeer::doSelect($c);
  }


  /**
   * Ver GroundPeer::doSelectRelationsWithI18n
   *
   * 
   * @access public
   */
  public function getRelationsWithI18n()
  {
    $c = new Criteria();
    $c->addJoin(GroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
    $c->addJoin(RelationGroundPeer::TWO_ID, GroundPeer::ID);
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->add(RelationGroundPeer::ONE_ID, $this->getId());

    return GroundPeer::doSelectWithI18n($c, $this->getCulture());
  }


  public function getVirtualGroundId()
  {
    $c = new Criteria();
    $c->add(VirtualGroundRelationPeer::ENABLE, true);
    $c->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

    $aux = VirtualGroundRelationPeer::doSelectOne($c);
    return (is_null($aux)?null:$aux->getVirtualGroundId());
  }
}
