<?php

/**
 * MatTypePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'mat_type'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MatTypePeer extends BaseMatTypePeer
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
   * @return class MatType
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }

  public static function doSelectOrdered() {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(self::TYPE);
    return self::doSelectWithI18n($c);
  }
}
