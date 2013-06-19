<?php

/**
 * Subclass for performing query and update operations on the 'ground' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class GroundPeer extends BaseGroundPeer
{

  /**
   * 
   * @access public
   */
  public static function doSelectRelations($id)
  {
    $c = new Criteria();
    $c->addJoin(GroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
    $c->addJoin(RelationGroundPeer::TWO_ID, GroundPeer::ID);
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->add(RelationGroundPeer::ONE_ID, $id);

    return GroundPeer::doSelect($c);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectRelationsWithI18n($id, $culture)
  {
    $c = new Criteria();
    $c->addJoin(GroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
    $c->addJoin(RelationGroundPeer::TWO_ID, GroundPeer::ID);
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->add(RelationGroundPeer::ONE_ID, $id);

    return GroundPeer::doSelectWithI18n($c, $culture);
  }

  public static function doSelectYtList()
  {
    $c = new Criteria();
    $c->add(GroundPeer::COD, 'YT%', CRITERIA::LIKE);
    return GroundPeer::doSelectWithI18n($c);
  }
}
