<?php

/**
 * PersonPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'person'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PersonPeer extends BasePersonPeer
{

  /**
   * Lista las personas pertenecientes a un objeto multimedia y un rol.
   * 
   * @access public
   * @param integer $mm_id id del objeto multimedia
   * @param integer $role_id id del rol de la person (por defecto todos los roles)
   * @param string $culture
   * @return ResulSet of Person
   */
  public static function doList($mm_id, $role_id = 0, $culture = null)
  {
    $c = new Criteria();
    $c->addJoin(PersonPeer::ID, MmPersonPeer::PERSON_ID);
    $c->add(MmPersonPeer::MM_ID, $mm_id);
    if ($role_id != 0) $c->add(MmPersonPeer::ROLE_ID, $role_id);
    $c->addAscendingOrderByColumn(MmPersonPeer::RANK);

    return PersonPeer::doSelectWithI18n($c, $culture);
  }


  /**
   * Lista las personas pertenecientes a un objeto multimedia y un rol.
   * 
   * @access public
   * @param integer $mm_id id del objeto multimedia
   * @param integer $role_id id del rol de la person (por defecto todos los roles)
   * @param string $culture
   * @return ResulSet of Person
   */
  public static function doListTemplate($mm_id, $role_id = 0, $culture = null)
  {
    $c = new Criteria();
    $c->addJoin(PersonPeer::ID, MmTemplatePersonPeer::PERSON_ID);
    $c->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $mm_id);
    if ($role_id != 0) $c->add(MmTemplatePersonPeer::ROLE_ID, $role_id);
    $c->addAscendingOrderByColumn(MmTemplatePersonPeer::RANK);

    return PersonPeer::doSelectWithI18n($c, $culture);
  }

  /**
   * Devuelve la primera persona con ese nombre
   *
   * @access public
   * @param string $name
   * @param integer $role_id id del rol de la person (por defecto todos los roles)
   * @param string $culture
   * @return ResulSet of Person
   */
  public static function retrieveByNameWithI18n($name, $culture = null)
  {
    $c = new Criteria();
    $c->add(PersonPeer::NAME, $name);
    $c->setLimit(1);
    $objects = PersonPeer::doSelectWithI18n($c, $culture);
    if ($objects) {
      return $objects[0];
    }
    return null;
  }

  /**
   * Devuelve la primera persona con ese email
   *
   * @access public
   * @param string $email
   * @param integer $role_id id del rol de la person (por defecto todos los roles)
   * @param string $culture
   * @return ResulSet of Person
   */
  public static function retrieveByEmailWithI18n($email, $culture = null)
  {
    $c = new Criteria();
    $c->add(PersonPeer::EMAIL, $email);
    $c->setLimit(1);
    $objects = PersonPeer::doSelectWithI18n($c, $culture);
    if ($objects) {
      return $objects[0];
    }
    return null;
  }
}
