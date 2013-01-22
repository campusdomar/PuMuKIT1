<?php

/**
 * MimeTypePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'mime_type'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MimeTypePeer extends BaseMimeTypePeer
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
   * Devuelve el objeto selecionado por defecto.
   * 
   * @access public
   * @return class MimeType
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
}
