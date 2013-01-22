<?php

/**
 * Subclass for representing a row from the 'mm_template' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MmTemplate extends BaseMmTemplate
{


  /**
   *
   *
   */
  public function getPlace($con = null)
  {
      $c = new Criteria();
      $c->addJoin(PlacePeer::ID, PrecinctPeer::PLACE_ID);
      $c->add(PrecinctPeer::ID, $this->getPrecinctId());
      list($resp) = PlacePeer::doSelectWithI18n($c, $this->getCulture());
      return $resp;
  }


  /**
   *
   *
   */
  public function getPlaceId($con = null)
  {
      return $this->getPlace()->getId();
  }


  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Grounds.
   */
  public function getGrounds($ground_type = 0)
  {
    $c = new Criteria();

    $c->addJoin(GroundPeer::ID, GroundMmTemplatePeer::GROUND_ID);
    $c->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelect($c);
  }

  /**
   * Asocio el objeto multimedia a dicho ground, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $ground_id
   */
  public function setGroundId($ground_id)
  {
    $gv =  GroundMmTemplatePeer::retrieveByPK($ground_id, $this->getId());
    if (!$gv){
      $gv = new GroundMmTemplate();
      $gv->setMmTemplateId($this->getId());
      $gv->setGroundId($ground_id);
      $gv->save();
    }
  }

  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Ground.
   */
  public function getGroundsWithI18n($ground_type = 0)
  {
    $c = new Criteria();

    $c->addJoin(GroundPeer::ID, GroundMmTemplatePeer::GROUND_ID);
    $c->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve las personas asociadas al objeto multimedia, con el
   * rol dado, si rol es cero se devuelve todas las personas con rol visible.
   *
   * @access public
   * @param integer $role_id
   * @return ResulSet of Person
   */
  public function getPersons($role_id = 0)
  {
    $c = new Criteria();
    $c->addJoin(PersonPeer::ID, MmTemplatePersonPeer::PERSON_ID);
    $c->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());
    if ($role_id != 0) {
      $c->add(MmTemplatePersonPeer::ROLE_ID, $role_id);
    }
    else {
      $c->add(RolePeer::DISPLAY, true);
      $c->addJoin(PersonPeer::ROLE_ID, RolePeer::ID);
    }
    $c->addAscendingOrderByColumn(MmTemplatePersonPeer::RANK);

    return PersonPeer::doSelectWithI18n($c, $this->getCulture());
  }


}
