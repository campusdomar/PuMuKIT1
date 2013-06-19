<?php

/**
 * GenrePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'genre'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class GenrePeer extends BaseGenrePeer
{

  /**
   * Devuelve el Id del valor selecionado 
   * por defecto.
   * 
   * @access public
   * @return integer Id 
   */
  public static function getDefaultSelId()
  {
    return DefaultSelectBehavior::getDefaultSelectId(__CLASS__);
  }


  /**
   * Devuelve el valor selecionado por defecto.
   * 
   * @access public
   * @return class Broadcast
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
  /**
   *
   */
  public static function doSelectByAbcWithI18n($culture = null)
  {
    if ($culture === null)
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

    $c = new Criteria();
    $c->addAscendingOrderByColumn(GenreI18nPeer::NAME);
    return GenrePeer::doSelectWithI18n($c, $culture);
  }
}
